/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tn.artfulio.gui;

import com.codename1.l10n.ParseException;
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
public class EditFormEvenement extends BaseForm{
    ServiceEvenement service = ServiceEvenement.getinstance();
    public EditFormEvenement(Evenement e) throws ParseException {

        this.init(Resources.getGlobalResources());
        TextField titreField = new TextField(e.getTitre(), "titre");
        TextField typeField = new TextField(e.getType(), "type");
        TextField descriptionField = new TextField(e.getDescription(), "description");
        TextField adresseField = new TextField(e.getDescription(), "adresse");
        Picker date_debut = new Picker();
        date_debut.setDate(e.getDate_debut());
        Picker date_fin = new Picker();
        date_debut.setDate(e.getDate_fin());
        
        this.add(titreField);
        this.add(typeField);
        this.add(descriptionField);
        this.add(adresseField);
        this.add(date_debut);
        this.add(date_fin);
        
        Button submitButton = new Button("Submit");
        submitButton.addActionListener(s-> {
            String titre = titreField.getText();
            String typee = typeField.getText();
            String desc = descriptionField.getText();
            String adresse = adresseField.getText();
            Date date_d = date_debut.getDate();
            Date date_f = date_fin.getDate();

            Evenement evenement = new Evenement();
            evenement.setId(e.getId());
            evenement.setTitre(titre);
            evenement.setType(typee);
            evenement.setDescription(desc);
            evenement.setAdresse(adresse);
            evenement.setDate_debut(date_d);
            evenement.setDate_fin(date_f);
            
            service.editEvenement(evenement);
            GetEvenementForm myForm = new GetEvenementForm();
            myForm.show();
        }
        );
        Button goToFormButton = new Button("Go back");
        goToFormButton.addActionListener(ee -> {
            GetEvenementForm myForm = new GetEvenementForm();
            myForm.show();
        });
        Button deleteButton = new Button("Delete");
        deleteButton.addActionListener(cc -> {
            service.delEvenement(e);
            GetEvenementForm myForm = new GetEvenementForm();
            myForm.show();
        });
        this.add(deleteButton);
        this.add(goToFormButton);
        this.add(submitButton);
    }

}
