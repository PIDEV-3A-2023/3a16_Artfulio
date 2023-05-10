/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tn.artfulio.gui;

import com.codename1.ui.Container;
import com.codename1.ui.FontImage;
import com.codename1.ui.Image;
import com.codename1.ui.Label;
import com.codename1.ui.Toolbar;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.util.Resources;

/**
 *
 * @author lelou
 */
public class BaseForm extends com.codename1.ui.Form{
     public void init(Resources theme) {
        Toolbar tb = getToolbar();

        tb.getAllStyles().setBgColor(0xffffff);

        Image logo = theme.getImage("logo.png");
        Label logoLabel = new Label(logo);
        Container logoContainer = BorderLayout.center(logoLabel);
        logoContainer.setUIID("SideCommandLogo");
        tb.addComponentToSideMenu(logoContainer);

        Label taglineLabel = new Label("Gestion Evenement");
        taglineLabel.setUIID("SideCommandTagline");
        Container taglineContainer = BorderLayout.south(taglineLabel);
        taglineContainer.setUIID("SideCommand");

        tb.addComponentToSideMenu(taglineContainer);
        tb.addMaterialCommandToSideMenu("List Evenement", FontImage.MATERIAL_LIST, e -> {
            GetEvenementForm f = new GetEvenementForm();
            f.show();
        });
        tb.addMaterialCommandToSideMenu("Ajouter Evenement", FontImage.MATERIAL_ADD, e -> {
            NewEvenementForm f = new NewEvenementForm();
            f.show();
        });
    }
}
