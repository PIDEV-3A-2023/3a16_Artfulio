/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tn.artfulio.services;

import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.ui.events.ActionListener;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Map;
import tn.artfulio.entities.Evenement;
import tn.artfulio.utils.Statics;

/**
 *
 * @author lelou
 */
public class ServiceEvenement {
     ArrayList<Evenement> evenements;
    ConnectionRequest req;
    public boolean resultOk;
    //2  creer un attribut de type de la classe en question (static)
    public static ServiceEvenement instance = null;
    
    private ServiceEvenement(){
        req = new ConnectionRequest();
        req.setInsecure(true);
    }
    
    //3 la methode qu'elle va ramplacer le constructeur 
    public static ServiceEvenement getinstance(){
        if(instance == null){
            instance = new ServiceEvenement();    
        }
        return instance;
    }

   //methode d'affichage
     public ArrayList<Evenement> getAllEvenements(){
          String url = Statics.BASE_URL+"/mobile/evenement";
          req.setUrl(url);
          req.setPost(false);
          req.addResponseListener(new ActionListener<NetworkEvent>() {
              @Override
              public void actionPerformed(NetworkEvent evt) {
                  evenements = parseEvenements(new String(req.getResponseData()));
                  req.removeResponseListener(this);
              }
          });
          NetworkManager.getInstance().addToQueueAndWait(req);
          for(Evenement e : evenements){
              System.out.println(e+"\n");
          }
         return evenements;
     }  
   
       public void newEvenement(Evenement e) {
        
      /*  String titre = e.getTitre();
        String type= e.getType();
        String adresse= e.getAdresse();
        String description = e.getDescription(); */
      //  req.addArgument("date_debut", e.getDate_debut().toString());
       // req.addArgument("date_fin", e.getDate_fin().toString());
       // String url = Statics.BASE_URL+"/mobile/evenement/add"+"?titre="+titre+"&type="+type+"&description="+"/"+description+"&adresse="+adresse;   
      // String url = Statics.BASE_URL + "/artwork/addart" + "?nom=" + nom + "&description=" + description + "&lien=" + lien + "&prix=" + prix+ "&img=" + img+ "&artist=" + artist;
        String url = Statics.BASE_URL+"/mobile/evenement/add";
        req.setUrl(url);
        req.setInsecure(true);
        this.req.setHttpMethod("POST");
      //   req.setPost(false);
        req.addArgument("titre", e.getTitre());
        req.addArgument("type", e.getType());
        req.addArgument("adresse", e.getAdresse());
        req.addArgument("description", e.getDescription());
        req.addArgument("date_debut", e.getDate_debut().toString());
        req.addArgument("date_fin", e.getDate_fin().toString()); 
     
     req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
            
                if(req.getResponseCode() == 200){
                    System.out.println("sa marche");
                }else{
                    System.out.println("ca ne marche pass");
                }
            }
        });
        
        System.out.println("je suis a service  new event avec: "+e);
        NetworkManager.getInstance().addToQueueAndWait(req); 
    }

         public void editEvenement(Evenement e) {

        req.setInsecure(true);
        this.req.setUrl(Statics.BASE_URL + "/mobile/evenement/edit/"+e.getId());
        this.req.setHttpMethod("PUT");
        req.addArgument("titre", e.getTitre());
        req.addArgument("type", e.getType());
        req.addArgument("adresse", e.getAdresse());
        req.addArgument("description", e.getDescription());
     //   req.addArgument("date_debut", e.getDate_debut().toString());
     //   req.addArgument("date_fin", e.getDate_fin().toString());
        
        NetworkManager.getInstance().addToQueue(req);
    }
         
         public void delEvenement(Evenement e) {
        req.setInsecure(true);
        this.req.setUrl(Statics.BASE_URL + "/mobile/evenement/delete/"+e.getId());
        this.req.setHttpMethod("DELETE");
        NetworkManager.getInstance().addToQueue(req);
    }
         
      

 
         
     //parsing    
      public ArrayList<Evenement> parseEvenements(String jsonText){

         try {
            evenements = new ArrayList<Evenement>();
             JSONParser j = new JSONParser();
             Map<String, Object> evenementListJson
                    = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));

            java.util.List<Map<String, Object>> list = (java.util.List<Map<String, Object>>) evenementListJson.get("root");
            for (Map<String, Object> obj : list) {
                Evenement e = new Evenement();
                float id = Float.parseFloat(obj.get("id").toString());
                e.setId((int) id);
             //   t.setStatus(((int) Float.parseFloat(obj.get("status").toString())));
                if (obj.get("titre") == null) {
                    e.setTitre("vide");
                } else {
                    e.setTitre(obj.get("titre").toString());
                }
                if (obj.get("type") == null) {
                    e.setType("vide");
                } else {
                    e.setType(obj.get("type").toString());
                }
                if (obj.get("description") == null) {
                    e.setDescription("null");
                } else {
                    e.setDescription(obj.get("description").toString());
                }
                if (obj.get("adresse") == null) {
                    e.setAdresse("vide");
                } else {
                    e.setAdresse(obj.get("adresse").toString());
                }
               /* if (obj.get("date_debut") == null) {
                    e.setDate_debut(new Date());
                } else {
                  //  e.setDate_debut(obj.get("date_debut").toString());
                  e.setDate_debut(new Date());
                }
                if (obj.get("date_fin") == null) {
                    e.setDate_fin(new Date());
                } else {
                    //e.setDate_fin(obj.get("date_fin").toString());
                    e.setDate_fin(new Date());
                }  */
                evenements.add(e); 
            }

        } catch (IOException ex) {
            System.out.println(ex.getMessage());
        }
        return evenements;
    }  
}
