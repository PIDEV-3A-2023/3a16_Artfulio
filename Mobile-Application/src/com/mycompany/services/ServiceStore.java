/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.services;

import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkManager;
import com.mycompany.entities.Store;
import com.mycompany.utils.Statics;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 *
 * @author Asus
 */
public class ServiceStore {
     private static final String BASE_URL = "http://127.0.0.1:8000/";
    private ConnectionRequest connection;
    public static ServiceStore instance = null;
    
    
    private ConnectionRequest req;
    
    public static ServiceStore getInstance(){
    
        if (instance == null)
            instance = new ServiceStore();
        return instance;
    }
    
    public ServiceStore(){
    
        connection = new ConnectionRequest();
        connection.setInsecure(true);
    }
    
    
      public List<Store> affichageStore() {
    String url = BASE_URL + "admin/store/affjson";
    this.connection.setUrl(url);
    this.connection.setHttpMethod("GET");
    List<Store> stores = new ArrayList<>();
    this.connection.addResponseListener(e -> {
        if (this.connection.getResponseCode() == 200) {
            String response = new String(this.connection.getResponseData());
            try {
                JSONArray jsonEvents = new JSONArray(response);
                for (int i = 0; i < jsonEvents.length(); i++) {
                    JSONObject jsonEvent = jsonEvents.getJSONObject(i);
                   // JSONObject artworkJson = jsonEvent.getJSONObject("artwork");
                    Store store = new Store(jsonEvent.getInt("idProduit"), jsonEvent.getInt("idPieceArt"), 
                        jsonEvent.getString("nomArtwork"), jsonEvent.getString("imgArtwork"), jsonEvent.getFloat("prixArtwork"));
                  
                    stores.add(store);
                }
                
            } catch (JSONException ex) {
                ex.printStackTrace();
            }
        } else {
            // handle the error
        }
    });
    
    NetworkManager.getInstance().addToQueueAndWait(this.connection);
    return stores;
}




    
    
    public Store DetailStore(int id, Store st){
    
        String url = Statics.BASE_URL+"/admin/store/"+st.getId_produit()+"json";
        req.setUrl(url);
        String str = new String(req.getResponseData());
        
        req.addResponseListener((evt) ->{
        
        JSONParser jsonp = new JSONParser();
            try {
             Map<String,Object>mapStore = jsonp.parseJSON(new CharArrayReader(new String(str).toCharArray()));

             
             
             st.setId_produit(Integer.parseInt(mapStore.get("id_produit").toString()));
                    st.setId_piece_art(Integer.parseInt(mapStore.get("id_piece_art").toString()));
                    st.setNom_artwork(mapStore.get("nom_artwork").toString());
                    st.setPrix_artwork(Integer.parseInt(mapStore.get("prix_artwork").toString()));
                    st.setImg_artwork(mapStore.get("img_artwork").toString());
                    
            } catch (Exception e) {
        
                System.out.println("error related to sql :("+e.getMessage());
            }
        
                System.out.println("data ===" +str); 
                
        
        
        
        });
    
            NetworkManager.getInstance().addToQueueAndWait(req);
            
            return st;
    }
    
    
     public void editStore(Store s) {
        connection = new ConnectionRequest();
        connection.setInsecure(true);
        this.connection.setUrl(BASE_URL + "admin/store/"+s.getId_produit()+"/editjson");
        this.connection.setHttpMethod("PUT");
        
        connection.addArgument("nom_artwork", s.getNom_artwork());
        connection.addArgument("prix_artwork", Float.toString(s.getPrix_artwork()));
        connection.addArgument("img_artwork", s.getImg_artwork());
        NetworkManager.getInstance().addToQueue(connection);
         System.out.println(s.getId_produit());
    }
    
     public void delStore(Store s) {
    ConnectionRequest connection = new ConnectionRequest();
    connection.setInsecure(true);
    connection.setUrl(BASE_URL + "admin/store/" + s.getId_produit() + "/deljson");
    connection.setHttpMethod("GET");
    NetworkManager.getInstance().addToQueueAndWait(connection);
}
}

