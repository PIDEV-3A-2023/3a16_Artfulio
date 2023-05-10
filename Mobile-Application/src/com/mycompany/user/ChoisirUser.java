/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.user;

import com.codename1.components.SpanLabel;
import com.codename1.ui.Button;
import com.codename1.ui.ComboBox;
import com.codename1.ui.Command;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Toolbar;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.util.Resources;
import com.mycompany.entities.Utilisateur;
import com.mycompany.services.ServiceUtlisateur;
import java.util.ArrayList;
import java.util.Vector;

/**
 *
 * @author user
 */
public class ChoisirUser extends BaseForm{
     public ChoisirUser(Resources res) {
        super(new BorderLayout());
        setTitle("Choisir un user");
        setLayout(BoxLayout.y());
         
        Toolbar tb = new Toolbar(true);
        setToolbar(tb);
        tb.setUIID("Container");
        getTitleArea().setUIID("Container");
        Form previous = Display.getInstance().getCurrent();
        tb.setBackCommand("", e -> previous.showBack());
        setUIID("SignIn");

        /*SpanLabel sp = new SpanLabel();
        sp.setText(ServiceUtlisateur.getInstance().getAllUsers().toString());
        add(sp);*/
         
        ArrayList<Utilisateur> users = ServiceUtlisateur.getInstance().getAllUsers();
        for (Utilisateur t : users) {
            addElement(t);
        }

        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_BACK, e -> previous.showBack());
Vector<String> vectorRole;
        vectorRole = new Vector();
     
         for (Utilisateur t : users) {
            vectorRole.add(Integer.toString(t.getId()));
        }
         
           ComboBox<String>roles = new ComboBox<>(vectorRole);
           Container content = BoxLayout.encloseY(
                
               
                createLineSeparator(),
            
                roles
        );
                   Button next = new Button("Selectioner");
                    
                   
                    content.setScrollableY(true);
        add( content);
        add(next);
            next.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                
               
                {
                    try {
                        int id=Integer.parseInt(roles.getSelectedItem());
                        Utilisateur u= new Utilisateur();
                        u=ServiceUtlisateur.getInstance().rechercher(id);
                        System.out.print(u);
                        new ModifierUser(res,u).show();
                    } catch (NumberFormatException e) {
                        Dialog.show("ERROR", "Status must be a number", new Command("OK"));
                    }
                    
                }
                
                
            }
        });
       
     


      
    }
    
    
    
     public void addElement(Utilisateur u) {

      SpanLabel t = new SpanLabel(u.toString());
                add(t);
        //add(t1);

    }
}
