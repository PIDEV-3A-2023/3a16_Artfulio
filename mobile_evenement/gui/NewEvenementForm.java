/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tn.artfulio.gui;

import com.codename1.ui.Button;
import com.codename1.ui.TextField;
import com.codename1.ui.spinner.Picker;
import com.codename1.ui.util.Resources;
import java.util.Date;
import tn.artfulio.entities.Evenement;
import tn.artfulio.services.ServiceEvenement;

/**
 *
 * @author lelou
 */
public class NewEvenementForm extends BaseForm{
    public NewEvenementForm() {
        this.init(Resources.getGlobalResources());
        TextField titreField = new TextField("", "Titre");
        TextField typeField = new TextField("","Type");
        TextField descriptionField = new TextField("","Description");
        TextField adresseField = new TextField("","Adresse");
        Picker date_debut = new Picker();
        Picker date_fin = new Picker();

        this.add(titreField);
        this.add(typeField);
        this.add(descriptionField);
        this.add(adresseField);
        this.add(date_debut);
        this.add(date_fin);

        Button submitButton = new Button("Ajouter");

        submitButton.addActionListener((evt) -> {
        String titre = titreField.getText();
            String typee = typeField.getText();
            String desc = descriptionField.getText();
            String adresse = adresseField.getText();
            Date date_d = date_debut.getDate();
            Date date_f = date_fin.getDate();

            Evenement evenement = new Evenement();
            evenement.setTitre(titre);
            evenement.setType(typee);
            evenement.setDescription(desc);
            evenement.setAdresse(adresse);
            evenement.setDate_debut(date_d);
            evenement.setDate_fin(date_f);
            ServiceEvenement service = ServiceEvenement.getinstance();
            service.newEvenement(evenement);
        });
      /*  submitButton.addActionListener(s
                -> {
            String titre = titreField.getText();
            String typee = typeField.getText();
            String desc = descriptionField.getText();
            String adresse = adresseField.getText();
            Date date_d = date_debut.getDate();
            Date date_f = date_fin.getDate();

            Evenement evenement = new Evenement();
            evenement.setTitre(titre);
            evenement.setType(typee);
            evenement.setDescription(desc);
            evenement.setAdresse(adresse);
            evenement.setDate_debut(date_d);
            evenement.setDate_fin(date_f);
            
            ServiceEvenement service = ServiceEvenement.getinstance();
            service.newEvenement(evenement);
        }
        ); */
        this.add(submitButton);
        Button goToFormButton = new Button("Retour");
        goToFormButton.addActionListener(e -> {
            GetEvenementForm myForm = new GetEvenementForm();
            myForm.show();
        });
        this.add(goToFormButton);
    }
}
