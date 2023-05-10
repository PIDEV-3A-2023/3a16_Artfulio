package com.mycompany.services;

import com.codename1.io.ConnectionRequest;
import com.codename1.io.NetworkManager;
import java.util.ArrayList;
import java.util.List;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import  com.mycompany.entities.Promotion;

public class PromotionWebService {

    private static final String BASE_URL = "http://127.0.0.1:8000/api";
    private ConnectionRequest connection;

    public PromotionWebService() {
        connection = new ConnectionRequest();
        connection.setInsecure(true);
    }

    public List<Promotion> getAllPromotions() {
        String url = BASE_URL + "/promotion";
        this.connection.setUrl(url);
        this.connection.setHttpMethod("GET");
        List<Promotion> promotions = new ArrayList<>();
        this.connection.addResponseListener(e -> {
            if (this.connection.getResponseCode() == 200) {
                String response = new String(this.connection.getResponseData());
                try {
                    JSONArray jsonEvents = new JSONArray(response);
                    for (int i = 0; i < jsonEvents.length(); i++) {
                        JSONObject jsonEvent = jsonEvents.getJSONObject(i);
                        Promotion promotion = new Promotion(
                                jsonEvent.getInt("id"),
                                jsonEvent.getInt("remise"),
                                jsonEvent.getString("type"),
                                jsonEvent.getString("nom_artwork"),
                                jsonEvent.getString("prix_artwork")
                        );
                        promotions.add(promotion);
                    }
                } catch (JSONException ex) {
                    ex.printStackTrace();
                }
            } else {
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(this.connection);
        return promotions;
    }

    public void newPromotion(Promotion p) {
        connection = new ConnectionRequest();
        connection.setInsecure(true);
        this.connection.setUrl(BASE_URL + "/promotion/add");
        this.connection.setHttpMethod("POST");

        connection.addArgument("remise", p.getRemise() + "");
        connection.addArgument("type", p.getType());
        connection.addArgument("id_artwork", p.getId_artwork() + "");
        connection.addArgument("nom_artwork", p.getNom_artwork());
        connection.addArgument("prix_artwork", p.getPrix_artwork());

        NetworkManager.getInstance().addToQueue(connection);
    }

    public void editPromotion(Promotion p) {
        connection = new ConnectionRequest();
        connection.setInsecure(true);
        this.connection.setUrl(BASE_URL + "/promotion/" + p.getId());
        this.connection.setHttpMethod("PUT");

        connection.addArgument("remise", p.getRemise() + "");
        connection.addArgument("type", p.getType());
        connection.addArgument("id_artwork", p.getId_artwork() + "");
        connection.addArgument("nom_artwork", p.getNom_artwork());
        connection.addArgument("prix_artwork", p.getPrix_artwork());

        NetworkManager.getInstance().addToQueue(connection);
    }

    public void delPromotion(Promotion p) {
        connection = new ConnectionRequest();
        connection.setInsecure(true);
        this.connection.setUrl(BASE_URL + "/promotion/" + p.getId());
        this.connection.setHttpMethod("DELETE");
        NetworkManager.getInstance().addToQueue(connection);
    }

}
