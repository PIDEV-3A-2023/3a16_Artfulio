/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.GUI;

import com.codename1.ui.Button;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.codename1.ui.layouts.GridLayout;
import com.codename1.ui.util.Resources;

/**
 *
 * @author Andrew
 */
public class Home extends Form {
    public Home() {
    setTitle("Home");
    setLayout(new BorderLayout());

    // Header
    Container headerContainer = new Container(new FlowLayout(Component.CENTER));
    Label headerLabel = new Label("Choisier un option");
    headerContainer.add(headerLabel);
    add(BorderLayout.NORTH, headerContainer);

    // Body
    Container bodyContainer = new Container(new GridLayout(2, 1));
    
    // Add Task Button
    Button addReclamationButton = new Button("Ajouter réclamation");
    addReclamationButton.addActionListener(l -> new addReclamation(this).show());
    bodyContainer.add(addReclamationButton);

    // List Tasks Button
    Button listReclamationsButton = new Button("Liste reclamations");
    listReclamationsButton.addActionListener(l -> new ListReclamations(this).show());
    bodyContainer.add(listReclamationsButton);
    
    
    // List Tasks Button
    Button addParrainageButton = new Button("Ajouter une demande de parrainage");
    addParrainageButton.addActionListener(l -> new addParrainage(this).show());
    bodyContainer.add(addParrainageButton);
    
    // List Tasks Button
    Button listParrainagesButton = new Button("Liste parrainages");
    listParrainagesButton.addActionListener(l -> new ListParrainages(this).show());
    bodyContainer.add(listParrainagesButton);

    add(BorderLayout.CENTER, bodyContainer);
}
    

    
    
    
}
