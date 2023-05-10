package com.mycompany.services;

import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.ui.events.ActionListener;
import com.mycompany.entities.Parrainage;
import com.mycompany.utils.Statics;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Map;

public class ServiceParrainage {

    ArrayList<Parrainage> parrainages;
    ConnectionRequest req;

    public boolean resultOk;
    public static ServiceParrainage instance = null;

    public static final String BASE_URL = "http://127.0.0.1:8000/";

    private ServiceParrainage() {
        req = new ConnectionRequest();
    }

    public static ServiceParrainage getInstance() {
        if (instance == null) {
            instance = new ServiceParrainage();
        }
        return instance;
    }

    public boolean addParrainage(Parrainage parrainage) {
        int idUser = parrainage.getIdUser();

        String url = Statics.BASE_URL + "addParrainage?idUser=" + idUser;

        req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOk = req.getResponseCode() == 200;
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOk;
    }

    public ArrayList<Parrainage> parseParrainages(String jsonText) {
        try {
            parrainages = new ArrayList<>();
            JSONParser parser = new JSONParser();
            Map<String, Object> parrainagesListJson = parser.parseJSON(new CharArrayReader(jsonText.toCharArray()));

            java.util.List<Map<String, Object>> list = (java.util.List<Map<String, Object>>) parrainagesListJson.get("root");
            for (Map<String, Object> obj : list) {
                Parrainage parrainage = new Parrainage();
                float id = Float.parseFloat(obj.get("idParrainage").toString());
                parrainage.setIdParrainage((int) id);

                if (obj.get("idUser") != null) {
                    float userId = Float.parseFloat(obj.get("idUser").toString());
                    parrainage.setIdUser((int) userId);
                }

                parrainages.add(parrainage);
            }
        } catch (IOException ex) {
            System.out.println(ex.getMessage());
        }

        return parrainages;
    }

    public ArrayList<Parrainage> getAllParrainages() {
        String url = Statics.BASE_URL + "displayParrainages/";
        req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                parrainages = parseParrainages(new String(req.getResponseData()));
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);

        return parrainages;
    }

    public boolean updateParrainage(Parrainage parrainage) {
        int idParrainage = parrainage.getIdParrainage();
        int idUser = parrainage.getIdUser();

        String url = Statics.BASE_URL + "updateParrainage?idParrainage=" + idParrainage + "&idUser=" + idUser;

        req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOk = req.getResponseCode() == 200;
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOk;
    }

    public boolean deleteParrainage(int idParrainage) {
        String url = Statics.BASE_URL + "deleteParrainage?idParrainage=" + idParrainage;

        req.setUrl(url);
        req.setPost(true);
        req.addArgument("idParrainage", String.valueOf(idParrainage));
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOk = req.getResponseCode() == 200;
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOk;
    }

    public ArrayList<Parrainage> getParrainageByidUser(int idUser) {
        ArrayList<Parrainage> allParrainages = ServiceParrainage.getInstance().getAllParrainages();
        ArrayList<Parrainage> filteredParrainages = new ArrayList<>();

        // Iterate through all parrainages and filter by idUser
        for (Parrainage parrainage : allParrainages) {
            if (parrainage.getIdUser() == idUser) {
                filteredParrainages.add(parrainage);
            }
        }

        return filteredParrainages;
    }
}

