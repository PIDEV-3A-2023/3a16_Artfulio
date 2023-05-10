package com.mycompany.services;

import com.codename1.io.ConnectionRequest;
import com.codename1.io.NetworkManager;
import java.util.ArrayList;
import java.util.List;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import com.mycompany.entities.Categorie;
public class CategorieWebService {

    private static final String BASE_URL = "http://127.0.0.1:8000/api";
    private ConnectionRequest connection;

    public CategorieWebService() {
        connection = new ConnectionRequest();
        connection.setInsecure(true);
    }

    public List<Categorie> getAllCategorie() {
        String url = BASE_URL + "/categorie";
        this.connection.setUrl(url);
        this.connection.setHttpMethod("GET");
        List<Categorie> categories = new ArrayList<>();
        this.connection.addResponseListener(e -> {
            if (this.connection.getResponseCode() == 200) {
                String response = new String(this.connection.getResponseData());
                try {
                    JSONArray jsonEvents = new JSONArray(response);
                    for (int i = 0; i < jsonEvents.length(); i++) {
                        JSONObject jsonEvent = jsonEvents.getJSONObject(i);
                        Categorie categorie = new Categorie(
                                jsonEvent.getInt("id"),
                                jsonEvent.getString("nom"),
                                jsonEvent.getString("type")
                        );
                        categories.add(categorie);
                    }
                } catch (JSONException ex) {
                    ex.printStackTrace();
                }
            } else {
            }
        });
        System.out.println(url);
        NetworkManager.getInstance().addToQueueAndWait(this.connection);
        return categories;
    }

    public void newCategorie(Categorie c) {
        connection = new ConnectionRequest();
        connection.setInsecure(true);
        this.connection.setUrl(BASE_URL + "/categorie/add");
        this.connection.setHttpMethod("POST");
        
        connection.addArgument("nom", c.getName());
        connection.addArgument("type", c.getType());

        NetworkManager.getInstance().addToQueue(connection);
    }
    
    public void editCategorie(Categorie c) {
        connection = new ConnectionRequest();
        connection.setInsecure(true);
        this.connection.setUrl(BASE_URL + "/categorie/"+c.getId());
        this.connection.setHttpMethod("PUT");
        connection.addArgument("nom", c.getName());
        connection.addArgument("type", c.getType());
        NetworkManager.getInstance().addToQueue(connection);
    }
    
    public void delCategorie(Categorie c) {
        connection = new ConnectionRequest();
        connection.setInsecure(true);
        this.connection.setUrl(BASE_URL + "/categorie/"+c.getId());
        this.connection.setHttpMethod("DELETE");
        NetworkManager.getInstance().addToQueue(connection);
    }

}
