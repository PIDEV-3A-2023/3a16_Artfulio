/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.gui;

import com.codename1.components.FloatingHint;
import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.io.Storage;
import com.codename1.ui.BrowserComponent;
import com.codename1.ui.Button;
import com.codename1.ui.Command;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.TextField;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.codename1.ui.util.Resources;
import com.mycompany.entities.Utilisateur;
import com.mycompany.myapp.utils.Statics;
import com.mycompany.services.ServiceUtlisateur;
import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

/**
 *
 * @author user
 */
public class Log_in extends BaseForm {

    public ConnectionRequest req;
    public ArrayList<Utilisateur> users;

    public Log_in(Resources res) {
        super(new BorderLayout());

        if (!Display.getInstance().isTablet()) {
            BorderLayout bl = (BorderLayout) getLayout();
            bl.defineLandscapeSwap(BorderLayout.NORTH, BorderLayout.EAST);
            bl.defineLandscapeSwap(BorderLayout.SOUTH, BorderLayout.CENTER);
        }
        getTitleArea().setUIID("Container");
        setUIID("SignIn");

        add(BorderLayout.NORTH, new Label(res.getImage("Logo.png"), "LogoLabel"));

        TextField email = new TextField("", "Email", 20, TextField.ANY);
        TextField password = new TextField("", "Password", 20, TextField.PASSWORD);
        email.setSingleLineTextArea(false);
        password.setSingleLineTextArea(false);
        Button signIn = new Button("Sign In");
        Button signUp = new Button("Sign Up");

        //mp oublié
        Button mp = new Button("oublier mot de passe?", "CenterLabel");
        Button Google = new Button("login avec google");
        Google.addActionListener(e -> {
            Form mainForm = new Form("Google Login", new BorderLayout());
            Container container = new Container(new BorderLayout());
            BrowserComponent browser = new BrowserComponent();
            browser.setURL("http://127.0.0.1:8000/fcb-login-json");

            container.add(BorderLayout.CENTER, browser);
            mainForm.add(BorderLayout.CENTER, container);

            container.setPreferredW(mainForm.getWidth());
            container.setPreferredH(mainForm.getHeight());

            mainForm.show();
            browser.addWebEventListener(BrowserComponent.onLoad, evt -> {
                String currentUrl = browser.getURL();
                if (currentUrl.startsWith("http://127.0.0.1:8000/fcb-callback-json")) {

                    String url = Statics.BASE_URL + "getuser";
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
                    Storage.getInstance().writeObject("Utilisateur", users.get(0));
                    new GestionUser(res).show();
                }
            });

        });

        signUp.addActionListener(e -> new Inscription(res).show());
        signUp.setUIID("Link");
        Label doneHaveAnAccount = new Label("Vous n'avez aucune compte?");

        Container content = BoxLayout.encloseY(
                new FloatingHint(email),
                createLineSeparator(),
                new FloatingHint(password),
                createLineSeparator(),
                signIn,
                FlowLayout.encloseCenter(doneHaveAnAccount, signUp), mp, Google
        );
        content.setScrollableY(true);
        add(BorderLayout.SOUTH, content);
        signIn.requestFocus();

        signIn.addActionListener(e
                -> {
            Utilisateur user = new Utilisateur();
            user = ServiceUtlisateur.getInstance().signin(email.getText(), password.getText(), res);
            if (!"nul".equals(user.getEmail())) {
                if (!"mdpnull".equals(user.getPassword())) {
                    /*if (user.getEtat() != 0) {
                        System.out.println(user.getEtat());
                        Storage.getInstance().writeObject("Utilisateur", user);
                        new GestionUser(res).show();
                    } else {
                        Dialog.show("Erreur", "User bloque", new Command("OK"));
                    }
                } else {*/
                    Dialog.show("Erreur", "Mot de passe incorrect", new Command("OK"));
                }
            } else {
                Dialog.show("Erreur", "email incorrect", new Command("OK"));
            }
        });

        //Mp oublie event
        mp.addActionListener((e) -> {

            new ForgetPass(res).show();

        });

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
}
