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
import com.mycompany.entities.Artwork;
import com.mycompany.utils.Statics;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Map;

/**
 *
 * @author Andrew
 */
public class ServiceArtwork2 {

    ArrayList<Artwork> parks;
    ConnectionRequest req;

    public boolean resultOk;
    //2  creer un attribut de type de la classe en question (static)
    public static ServiceArtwork2 instance = null;

    //Singleton => Design Pattern qui permet de creer une seule instance d'un objet 
    //1 rendre le constructeur private
    private ServiceArtwork2() {
        req = new ConnectionRequest();
    }

    //3 la methode qu'elle va ramplacer le constructeur 
    public static ServiceArtwork2 getinstance() {
        if (instance == null) {
            instance = new ServiceArtwork2();
        }
        return instance;
    }

    //methode d'ajout
    public boolean addPark(Artwork t) {
              String nom = t.getNom_artwork();
        String description = t.getDescription_artwork();
        String lien = t.getLien_artwork();
        int prix = t.getPrix_artwork();
        String img = t.getImg_artwork();
        int artist=t.getId_artist();
//        String url = Statics.BASE_URL+"/ajouterBadgeJson/new?typebadge="+typebadge +"&nbpoint=" +nbpoint;

        String url = Statics.BASE_URL + "/artwork/addart" + "?nom=" + nom + "&description=" + description + "&lien=" + lien + "&prix=" + prix+ "&img=" + img+ "&artist=" + artist;
//QR qr=new QR();
//      String path=t.getLien_artwork();
//     
//      qr.Create_QR(path,t.getNom_artwork());
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

public void parseParks(String jsonText, ArrayList<Artwork> parks) {
    if (jsonText == null) {
        System.err.println("Error: jsonText is null");
        return;
    }

    try {
        JSONParser j = new JSONParser();
        Map<String, Object> parksListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
        if (!parksListJson.containsKey("root")) {
            System.err.println("Error: JSON data is not in the expected format");
            return;
        }

        java.util.List<Map<String, Object>> list = (java.util.List<Map<String, Object>>) parksListJson.get("root");
        for (Map<String, Object> obj : list) {
            System.out.println("obj = " + obj);
            Artwork t = new Artwork();
            float id = Float.parseFloat(obj.get("id").toString());
            t.setId_artwork((int) id);
            Object nbspotObj = obj.get("nom");
           
            t.setDescription_artwork(obj.get("description").toString());
            t.setNom_artwork(obj.get("nom").toString());
            
            //t.setPrix_artwork(obj.get("prix_artwork").toString());
           // t.setDate(obj.get("date").toString());
//           dimension
//artist
//type
            t.setLien_artwork(obj.get("lien").toString());
            t.setImg_artwork(obj.get("image").toString());
            
            
            parks.add(t);
        }

    } catch (IOException ex) {
        System.err.println("Error: " + ex.getMessage());
    }
}



//a
public ArrayList<Artwork> getAllParks() {
    ArrayList<Artwork> parks = new ArrayList<>();
    String url ="http://127.0.0.1:8000/artwork/allArtwork";
    try {
        ConnectionRequest con = new ConnectionRequest();
        con.setUrl(url);
        con.setPost(false);
        con.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                String jsonText = new String(con.getResponseData());
                parseParks(jsonText, parks);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(con);
    } catch (Exception ex) {
        System.out.println(ex.getMessage());
    }
    return parks;
}

    public boolean deletePark(String id ) {
        
        String url = Statics.BASE_URL +"/artwork/supprimer/"+id;
        
        req.setUrl(url);
        
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                    
                    req.removeResponseCodeListener(this);
            }
        });
        
        NetworkManager.getInstance().addToQueueAndWait(req);
        return  resultOk;
    }
   public boolean modifierBadge(Artwork b,String id) {
//        String url = Statics.BASE_URL +"/modifierBadgeJSON/"+id+"?typebadge=" + b.getTypebadge()+ "&nbpoint=" + b.getNbpoint();
//        req.setUrl(url);
        
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOk = req.getResponseCode() == 200 ;  // Code response Http 200 ok
                req.removeResponseListener(this);
            }
        });
        
    NetworkManager.getInstance().addToQueueAndWait(req);//execution ta3 request sinon yet3ada chy dima nal9awha
    return resultOk;
        
    }
}
