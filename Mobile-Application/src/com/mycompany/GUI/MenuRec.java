/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.GUI;

import com.codename1.ui.Button;
import com.codename1.ui.Component;
import com.codename1.ui.Container;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.codename1.ui.util.Resources;
import com.mycompany.myapp.Home;

/**
 *
 * @author MSI
 */
public class MenuRec extends Form{
    Form current;
private Resources theme;


    public MenuRec(Form prev){
   current = this;
    setTitle("Gestion des Reclamtions");
    setLayout(new BorderLayout());
    add(BorderLayout.NORTH, new Label("choose an option "));
    
    Container buttonsContainer = new Container(new BoxLayout(BoxLayout.Y_AXIS));
    Button b1 = new Button("Ajouter Reclamtion");
    Button b2 = new Button("List des Reclamtions");

    b1.addActionListener(l -> new addReclamation (prev).show());
    b2.addActionListener(l -> new ListReclamations(prev).show());
    getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, e -> new Home(prev).showBack());
    
    buttonsContainer.add(b1);
    buttonsContainer.add(b2);
    
    add(BorderLayout.CENTER, buttonsContainer);
         
    }
}
