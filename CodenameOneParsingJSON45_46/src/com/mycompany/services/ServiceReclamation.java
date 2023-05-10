/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.services;

import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.ui.List;
import com.codename1.ui.events.ActionListener;
import com.mycompany.entities.Reclamation;
import com.mycompany.utils.Statics;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Map;
import com.codename1.l10n.L10NManager;
import com.codename1.util.StringUtil;

/**
 *
 * @author Andrew
 */
public class ServiceReclamation {

    ArrayList<Reclamation> reclamations;
    ConnectionRequest req;

    public boolean resultOk;
    //2  creer un attribut de type de la classe en question (static)
    public static ServiceReclamation instance = null;

    public static final String BASE_URL1 = "http://127.0.0.1:8000/";

    //Singleton => Design Pattern qui permet de creer une seule instance d'un objet 
    //1 rendre le constructeur private
    private ServiceReclamation() {
        req = new ConnectionRequest();
    }

    //3 la methode qu'elle va ramplacer le constructeur 
    public static ServiceReclamation getinstance() {
        if (instance == null) {
            instance = new ServiceReclamation();
        }
        return instance;
    }

    //methode d'ajout
    public boolean addTask(Reclamation t) {
        String titre = t.getTitre();
        String recsec = t.getReclamationSec();
        String email = t.getEmail();

        String url = Statics.BASE_URL + "addReclamation?titre="+t.getTitre()+"&reclamationSec="+t.getReclamationSec()+"&email="+t.getEmail();

        req.setUrl(url);
        //GET =>
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOk = req.getResponseCode() == 200; //si le code return 200 
                //
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOk;

    }

    public ArrayList<Reclamation> parseTasks(String jsonText) {
        try {
            reclamations = new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String, Object> tasksListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));

            java.util.List<Map<String, Object>> list = (java.util.List<Map<String, Object>>) tasksListJson.get("root");
            for (Map<String, Object> obj : list) {
                Reclamation t = new Reclamation();
                float id = Float.parseFloat(obj.get("idRec").toString());
                t.setIdRec((int) id);

                if (obj.get("titre") == null) {
                    t.setTitre("null");
                } else {
                    t.setTitre(obj.get("titre").toString());
                }

                if (obj.get("ReclamationSec") == null) {
                    t.setReclamationSec("null");
                } else {
                    t.setReclamationSec(obj.get("ReclamationSec").toString());
                }

                if (obj.get("email") == null) {
                    t.setEmail("null");
                } else {
                    t.setEmail(obj.get("email").toString());
                }

                reclamations.add(t);
            }

        } catch (IOException ex) {
            System.out.println(ex.getMessage());
        }

        return reclamations;
    }

    //methode d'affichage
    public ArrayList<Reclamation> getAllTasks() {
        String url = Statics.BASE_URL + "displayReclamations/";
        req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                reclamations = parseTasks(new String(req.getResponseData()));
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);

        return reclamations;
    }

    public boolean editTask(Reclamation t) {
    

    String url = Statics.BASE_URL + "updateReclamation?idRec="+t.getIdRec()+"&titre="+t.getTitre()+"&reclamationSec="+t.getReclamationSec()+"&email="+t.getEmail();

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


    public boolean deleteTask(int idRec) {
        String url = Statics.BASE_URL + "deleteReclamation?id="+idRec;

        req.setUrl(url);
        // DELETE =>
        req.setPost(true);
        req.addArgument("idRec", String.valueOf(idRec));
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOk = req.getResponseCode() == 200; // if the code returns 200
                //
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOk;
    }
    
    public ArrayList<Reclamation> getTasksByEmail(String email) {
    ArrayList<Reclamation> allTasks = ServiceReclamation.getinstance().getAllTasks();
    ArrayList<Reclamation> filteredTasks = new ArrayList<>();

    // Iterate through all tasks and filter by email
    for (Reclamation task : allTasks) {
        if (task.getEmail().equals(email)) {
            filteredTasks.add(task);
        }
    }

    return filteredTasks;
}

}
