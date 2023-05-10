/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.GUI;
import com.codename1.ui.Button;
import com.codename1.ui.CheckBox;
import com.codename1.ui.Dialog;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.TextField;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BoxLayout;
import com.mycompany.entities.Artwork;
import com.mycompany.services.ServiceArtwork2;
/**
 *
 * @author MSI
 */
public class addArtwork extends Form{
     public addArtwork(Form previous){
        
        setTitle("add Artwork");
        setLayout(BoxLayout.y());
         TextField nomField = new TextField("", "Nom");
        TextField descriptionField = new TextField("", "desc");
        TextField prixField = new TextField("", "prix");
        TextField typeField = new TextField("", "type");
        TextField artistField = new TextField("", "artist");
        TextField lienField = new TextField("", "lien");
        TextField dimensionField = new TextField("", "dimension");
        TextField imageField = new TextField("", "image");

        Button btnadd =new Button("add Artwork");
        
        
        btnadd.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                
                if(nomField.getText().length()==0 || nomField.getText().length()==0 ){
                    Dialog.show("Alert","please fill all the fiels","ok",null);
                }
                else{
                    
                     String nom = nomField.getText();
            String description = descriptionField.getText();
//            int prix = Integer.parseInt(prixField.getText());
            String lien = lienField.getText();
            String image = imageField.getText();
            int artist = Integer.parseInt(artistField.getText());
            
  Artwork newCat = new Artwork();
            newCat.setNom_artwork(nom);
            newCat.setDescription_artwork(description);
//            newCat.setPrix_artwork(prix);
            newCat.setLien_artwork(lien);
            newCat.setImg_artwork(image);
            newCat.setId_artist(artist);                   
            if(ServiceArtwork2.getinstance().addPark(newCat)){
                         Dialog.show("Alert","added successfuly","ok",null);
                         new ListArtwork(previous).show();
                    }else {
                         Dialog.show("Alert","Err while connecting to server ","ok",null);
                    }
                   
                }
            }
        });
        addAll(btnadd,nomField,descriptionField,artistField,lienField,dimensionField,imageField);
        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, ev->previous.show());
     
        
    }
    
}
