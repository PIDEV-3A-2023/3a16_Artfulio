package com.mycompany.GUI;

import com.codename1.ui.Button;
import static com.codename1.ui.Component.LEFT;
import static com.codename1.ui.Component.RIGHT;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.Style;
import com.codename1.ui.util.Resources;
import com.mycompany.entities.Artwork;
import com.mycompany.services.ServiceArtwork2;
//import com.mycompany.services.ServicePark;
import java.util.ArrayList;


public class ListArtwork extends Form {
    
     Form current;
   
    private Resources theme;
    
    public ListArtwork(Resources res, Form previous) {
        
        current = this; //Back 
     

        setTitle("List Artwork");
        setLayout(BoxLayout.y());

        ArrayList<Artwork> badges = ServiceArtwork2.getinstance().getAllParks();
        for (Artwork p : badges) {
            addElement(p);
        }

        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, ev -> previous.show());
    }
        
    public ListArtwork(Form previous) {
        setTitle("List Artwork");
        setLayout(BoxLayout.y());

        ArrayList<Artwork> tasks = ServiceArtwork2.getinstance().getAllParks();
        for (Artwork b : tasks) {
            addElement(b);
        }

        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_LEFT, ev -> previous.show());

    }
        public void addElement(Artwork b) {
//        Label a = new Label(b.getTypebadge(), "Welcome");

        Container cnt = new Container(new BoxLayout(BoxLayout.Y_AXIS));

        //kif nzidouh  ly3endo date mathbih fi codenamone y3adih string w y5alih f symfony dateTime w ytab3ni cha3mlt taw yjih
        Label nom = new Label("nom  : " + b.getNom_artwork());
        Label description = new Label("description  : " + b.getDescription_artwork());
        Label Artist = new Label("Artist  : " + b.getDescription_artwork());
        
        Label lien = new Label("lien  : " + b.getLien_artwork());
        Label image = new Label("image : " + b.getImg_artwork());
     
        


        //supprimer button
        Button lSupprimer = new Button();
        lSupprimer.setUIID("NewsTopLine");
        Style supprmierStyle = new Style(lSupprimer.getUnselectedStyle());
        supprmierStyle.setFgColor(0xf21f1f);

        FontImage suprrimerImage = FontImage.createMaterial(FontImage.MATERIAL_DELETE, supprmierStyle);
        lSupprimer.setIcon(suprrimerImage);
        lSupprimer.setTextPosition(RIGHT);

        //click delete icon
        lSupprimer.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent l) {
               // Dialog dig = new Dialog("Suppression");

               
                //n3ayto l suuprimer men service Reclamation ou nrefreshiw liste 
                ServiceArtwork2.getinstance().deletePark(String.valueOf(b.getId_artwork()));
                                                    Dialog.show("Suppression","Supprimé","ok",null);

                   //new ListArtwork(current).show();

            }
        });

        //Update icon 
        Button lModifier = new Button();
        lModifier.setUIID("NewsTopLine");
        Style modifierStyle = new Style(lModifier.getUnselectedStyle());
        modifierStyle.setFgColor(0xf7ad02);

        FontImage mFontImage = FontImage.createMaterial(FontImage.MATERIAL_MODE_EDIT, modifierStyle);
        lModifier.setIcon(mFontImage);
        lModifier.setTextPosition(LEFT);
        lModifier.addPointerPressedListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent l) {
                //System.out.println("hello update");
//                new mod(b, current,String.valueOf(b.getId_artwork())).show();
            }
        });
        //button vue sur map 
        Button map = new Button("mapView");
       // map.addActionListener(l -> new MapPark(current,String.valueOf(b.getId_artwork())).show());
        cnt.add(nom);
        cnt.add(description);
        cnt.add(lien);
        cnt.add(image);
        
      
        cnt.addAll(lSupprimer, lModifier);

        add(cnt);

    }}
    
    
    
    
    
    
    
    