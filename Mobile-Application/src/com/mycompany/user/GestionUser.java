/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.user;

import com.codename1.components.FloatingHint;
import com.codename1.io.Storage;
import com.codename1.ui.Button;
import com.codename1.ui.ComboBox;
import com.codename1.ui.Command;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.TextField;
import com.codename1.ui.Toolbar;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.codename1.ui.util.Resources;
import com.mycompany.entities.Utilisateur;
import java.util.Vector;
/**
 *
 * @author user
 */
public class GestionUser extends BaseForm{
    
     public GestionUser(Resources res) {
        super(new BorderLayout());
        
        Utilisateur u=new Utilisateur();
        u= (Utilisateur) Storage.getInstance().readObject("Utilisateur");
        
        Toolbar tb = new Toolbar(true);
        Label nom=new Label(u.getUsername());
                Button  Profile = new Button("Profile");
                Button  dec = new Button("Deconnecté");
        setToolbar(tb);
        tb.addComponentToLeftSideMenu(nom);
        tb.addComponentToLeftSideMenu(Profile);
        tb.addComponentToLeftSideMenu(dec);
        tb.setUIID("Container");
        getTitleArea().setUIID("Container");
        Form previous = Display.getInstance().getCurrent();
        //tb.setBackCommand("", e -> previous.showBack());
        setUIID("SignIn");
                
       
       
     
        
        
        
        
      Button next1 = new Button("Afficher");
        Button next = new Button("Ajouter");
     Button next2 = new Button("Modifier");
     Button next3 = new Button("Supprimer");
        next.addActionListener(e -> new AjouterUser(res).show());
      next1.addActionListener(e -> new ListUsers(res).show());
       next3.addActionListener(e -> new SupprimerUser(res).show());
       next2.addActionListener(e -> new ChoisirUser(res).show());
      Container content = BoxLayout.encloseY( new Label("Gestion Utilisateur"),createLineSeparator());
        content.setScrollableY(true);
        
        add(BorderLayout.CENTER, BoxLayout.encloseY(
                next1,next,next2,next3
        )
        
        );
        
        
        
        Profile.addActionListener(e -> new Profile_User(res).show());
        dec.addActionListener(e -> {Storage.getInstance().deleteStorageFile("Utilisateur");
                new Log_in(res).show();});
   
}



}
