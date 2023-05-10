/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.services;

import com.codename1.components.WebBrowser;
import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;

import com.codename1.ui.BrowserComponent;
import com.codename1.ui.Container;
import com.codename1.ui.Form;

import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.codename1.ui.util.Resources;
import com.mycompany.entities.Utilisateur;
import com.mycompany.user.GestionUser;
import com.mycompany.utils.Statics;

import java.io.IOException;
//import java.net.URLDecoder;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import javafx.scene.web.WebEvent;

/**
 *
 * @author user
 */
public class ServiceUtlisateur {

    public ConnectionRequest req;
    String test = new String();
    private static ServiceUtlisateur instance;
    public boolean resultOK;
    public ArrayList<Utilisateur> users;

    public ServiceUtlisateur() {
        req = new ConnectionRequest();
    }

    public static ServiceUtlisateur getInstance() {
        if (instance == null) {
            instance = new ServiceUtlisateur();
        }
        return instance;
    }

    public boolean addUser(Utilisateur user) {

        //String url = Statics.BASE_URL +"utilisateur_ajouter/new?nom="+user.getNom()+"&prenom="+user.getPrenom()+"&email="+user.getEmail()+"&mdp="+user.getMdp()+"&num=9585585"+"&adresse="+user.getAdresse()+"&type=Admin";
        String url = Statics.BASE_URL + "utilisateur_ajouter/new";

        req.setUrl(url);
        req.setPost(false);
        req.addArgument("username", user.getUsername());
        req.addArgument("cin_user", user.getCin_user());
        req.addArgument("email", user.getEmail());
        req.addArgument("password", user.getPassword());
        req.addArgument("roles", user.getRoles());
        req.addArgument("adresse_user", user.getAdresse_user());
        //req.addArgument("is_pro", Boolean.toString(user.isIs_pro()));

        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOK;

    }

    public ArrayList<Utilisateur> parseUser(String jsonText) {
        try {
            users = new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String, Object> tasksListJson
                    = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));

            List<Map<String, Object>> list = (List<Map<String, Object>>) tasksListJson.get("root");
            System.out.println(list.toString());
            for (Map<String, Object> obj : list) {
                Utilisateur t = new Utilisateur();
                if (obj.get("id") == null) {
                    t.setId(0);
                } else {
                    int id = Integer.parseInt(obj.get("id").toString());
                    t.setId(id);
                }

                if (obj.get("username") == null) {
                    t.setUsername("null");
                } else {
                    t.setUsername(obj.get("username").toString());
                }

                if (obj.get("cin_user") == null) {
                    t.setCin_user("null");
                } else {
                    t.setCin_user(obj.get("cin_user").toString());
                }

                if (obj.get("email") == null) {
                    t.setEmail("null");
                } else {
                    t.setEmail(obj.get("email").toString());
                }

                if (obj.get("password") == null) {
                    t.setPassword("null");
                } else {
                    t.setPassword(obj.get("password").toString());
                }

                if (obj.get("img_user") == null) {
                    t.setImg_user("null");
                } else {
                    t.setImg_user(obj.get("img_user").toString());
                }

                if (obj.get("adresse_user") == null) {
                    t.setAdresse_user("null");
                } else {
                    t.setAdresse_user(obj.get("adresse_user").toString());
                }

                if (obj.get("roles") == null) {
                    t.setRoles("null");
                } else {
                    t.setRoles(obj.get("roles").toString());
                }

                if (obj.get("is_pro") == null) {
                    t.setIs_pro(false);
                } else {
                    boolean isPro = Boolean.parseBoolean(obj.get("is_pro").toString());
                    t.setIs_pro(isPro);
                }

                users.add(t);
            }

        } catch (IOException ex) {

        }
        return users;
    }

    public ArrayList<Utilisateur> getAllUsers() {
        String url = Statics.BASE_URL + "utilisateur_afficher";
        req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                users = parseUser(new String(req.getResponseData()));
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return users;
    }

    public boolean SupprimerUser(int id) {

        //String url = Statics.BASE_URL +"utilisateur_ajouter/new?nom="+user.getNom()+"&prenom="+user.getPrenom()+"&email="+user.getEmail()+"&mdp="+user.getMdp()+"&num=9585585"+"&adresse="+user.getAdresse()+"&type=Admin";
        String url = Statics.BASE_URL + "utilisateur_supp/" + Integer.toString(id);
        System.out.print(url);

        req.setUrl(url);
        req.setPost(false);

        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOK;

    }

    public boolean ModifierUser(int id, Utilisateur user) {

        String url = Statics.BASE_URL + "utilisateur_update/" + Integer.toString(id);
        System.out.print(url);

        req.setUrl(url);
        req.setPost(false);
        req.addArgument("username", user.getUsername());
        req.addArgument("cin_user", user.getCin_user());
        req.addArgument("email", user.getEmail());
        req.addArgument("password", user.getPassword());
        req.addArgument("roles", user.getRoles());
        req.addArgument("adresse_user", user.getAdresse_user());
        //req.addArgument("is_pro", Boolean.toString(user.isIs_pro()));

        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOK;

    }

    public boolean BloqueUser(int id) {

        String url = Statics.BASE_URL + "bloqueUser/" + Integer.toString(id);
        System.out.print(url);

        req.setUrl(url);
        req.setPost(false);

        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOK;

    }

    public Utilisateur rechercher(int id) {
        users = new ArrayList<>();
        Utilisateur user = new Utilisateur();
        String url = Statics.BASE_URL + "utilisateur_recherche/" + Integer.toString(id);

        req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                users = pparseUser(new String(req.getResponseData()));
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);

        user.toString();
        return users.get(0);

    }

    public ArrayList<Utilisateur> pparseUser(String jsonText) {
        try {
            users = new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String, Object> tasksListJson = new HashMap<>();
            tasksListJson.put("key", j.parseJSON(new CharArrayReader(jsonText.toCharArray())));

            Map<String, Object> userJson = (Map<String, Object>) tasksListJson.get("key");

            Utilisateur t = new Utilisateur();
            float id = Float.parseFloat(userJson.get("id").toString());
            t.setId((int) id);

            if (userJson.get("username") == null) {
                t.setUsername("null");
            } else {
                t.setUsername(userJson.get("username").toString());
            }

            if (userJson.get("cin_user") == null) {
                t.setCin_user("null");
            } else {
                t.setCin_user(userJson.get("cin_user").toString());
            }

            if (userJson.get("email") == null) {
                t.setEmail("null");
            } else {
                t.setEmail(userJson.get("email").toString());
            }

            if (userJson.get("password") == null) {
                t.setPassword("null");
            } else {
                t.setPassword(userJson.get("password").toString());
            }

            if (userJson.get("img_user") == null) {
                t.setImg_user("null");
            } else {
                t.setImg_user(userJson.get("img_user").toString());
            }

            if (userJson.get("adresse_user") == null) {
                t.setAdresse_user("null");
            } else {
                t.setAdresse_user(userJson.get("adresse_user").toString());
            }

            if (userJson.get("roles") == null) {
                t.setRoles("null");
            } else {
                t.setRoles(userJson.get("roles").toString());
            }

            if (userJson.get("is_pro") == null) {
                t.setIs_pro(false);
            } else {
                boolean isPro = Boolean.parseBoolean(userJson.get("is_pro").toString());
                t.setIs_pro(isPro);
            }
            users.add(t);

        } catch (IOException ex) {
            System.out.println(ex.getMessage());
        }

        return users;
    }

    public Utilisateur signin(String email, String password, Resources res) {

        String url = Statics.BASE_URL + "utilisateur_login_admin";
        req.setUrl(url);
        req.setPost(false);
        req.addArgument("email", email);
        req.addArgument("mdp", password);

        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                users = parseUser(new String(req.getResponseData()));
                resultOK = req.getResponseCode() == 200;
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        Utilisateur u = new Utilisateur();
        if (resultOK) {
            u = users.get(0);
        } else {
            u = null;
        }
        return u;

    }

    public boolean Mdp_oublier(String email) {

        String url = Statics.BASE_URL + "email_mobile";
        req.setUrl(url);
        req.setPost(false);
        req.addArgument("email", email);

        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                System.out.print(users);
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);

        return resultOK;

    }

    public boolean Google_login() {

        String url = Statics.BASE_URL + "fcb-login-json";
        req.setUrl(url);
        req.setPost(false);
        System.out.print(url);

        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                String u = new String(req.getResponseData());
                test = u;

                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        System.out.print(test);
        /*  WebBrowser browser = new WebBrowser();
browser.setURL(test);

browser.addWebEventListener(new WebEventListener() {
    @Override
    public void webEvent(WebBrowser wb, WebEvent we) {
        if (we.getURL().startsWith("http://127.0.0.1:8000/fcb-callback-json")) {
            // The user has successfully logged in and redirected to the callback URL.
            // Parse the returned JSON data and extract the access token and other user information.
            // You can then use this information to authenticate the user in your app.
        }
    }
});*/
        Form form = new Form("Google Login");
        BrowserComponent browser = new BrowserComponent();

        String urlll = "https://google.com";

        browser.setURL(urlll);

        Container myContainer = new Container();
        myContainer.add(browser);
        form.add(myContainer);
        form.show();
        if (test != null) {
            resultOK = true;
        }
        return resultOK;

    }
    

}
