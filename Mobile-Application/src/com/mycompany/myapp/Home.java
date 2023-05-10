/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp;

import com.mycompany.GUI.*;
import com.codename1.ui.Button;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.util.Resources;

/**
 *
 * @author Andrew
 */
public class Home extends Form {

    Form current;
    private Resources theme;

    public Home(Form previous) {
        current = this; //Back 

        setTitle("Artfulio");
        setLayout(BoxLayout.y());
        Button park = new Button("Gestion des Promotions");
        Button cat = new Button("Gestion des Categorie");
        Button Artwork = new Button("Gestion des Artwork");
        Button Store = new Button("Gestion des Store");
        Button Reclamation = new Button("Gestion des Reclamations");
        

        park.addActionListener((evt) -> new MenuPromo(current).show());
        cat.addActionListener((evt) -> new MenuCat(current).show());
        Artwork.addActionListener((evt) -> new MenuArtwork(current).show());
        Store.addActionListener((evt) -> new MenuStore(current).show());
        Reclamation.addActionListener((evt) -> new MenuRec(current).show());
        

        addAll(park);
        addAll(cat);
        addAll(Artwork);
        addAll(Store);
        addAll(Reclamation);
        
        
        

    }

}
