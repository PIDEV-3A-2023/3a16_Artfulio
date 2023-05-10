package tn.gestion.artfulio.forms;

import com.codename1.ui.*;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.util.Resources;

public class BaseForm extends com.codename1.ui.Form {

    public void init(Resources theme) {
        Toolbar tb = getToolbar();

        tb.getAllStyles().setBgColor(0xffffff);

        Image logo = theme.getImage("logo.png");
        Label logoLabel = new Label(logo);
        Container logoContainer = BorderLayout.center(logoLabel);
        logoContainer.setUIID("SideCommandLogo");
        tb.addComponentToSideMenu(logoContainer);

        Label taglineLabel = new Label("Gestion promotion et categorie");
        taglineLabel.setUIID("SideCommandTagline");
        Container taglineContainer = BorderLayout.south(taglineLabel);
        taglineContainer.setUIID("SideCommand");
        
        tb.addComponentToSideMenu(taglineContainer);
        
        tb.addMaterialCommandToSideMenu("List Promotion", FontImage.MATERIAL_LIST, e -> {
            getPromotionForm f = new getPromotionForm();
            f.show();
        });
        tb.addMaterialCommandToSideMenu("Ajouter Promotion", FontImage.MATERIAL_ADD, e -> {
            newPromotionForm f = new newPromotionForm();
            f.show();
        });
        tb.addMaterialCommandToSideMenu("List Categorie", FontImage.MATERIAL_LIST, e -> {
            getCategorieForm f = new getCategorieForm();
            f.show();
        });
        tb.addMaterialCommandToSideMenu("Ajouter Categorie", FontImage.MATERIAL_ADD, e -> {
            newCategorieForm f = new newCategorieForm();
            f.show();
        });
    }
}
