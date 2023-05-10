/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tn.artfulio.gui;

import com.codename1.l10n.ParseException;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.list.DefaultListModel;
import com.codename1.ui.list.MultiList;
import com.codename1.ui.util.Resources;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import tn.artfulio.entities.Evenement;
import tn.artfulio.services.ServiceEvenement;

/**
 *
 * @author lelou
 */
public class GetEvenementForm extends BaseForm{
   private MultiList eventList;

    public GetEvenementForm() {
        this.init(Resources.getGlobalResources());
        eventList = new MultiList(new DefaultListModel<>());
        add(eventList);
        getAllEvenements();
    }

    private void getAllEvenements() {
        ServiceEvenement service = ServiceEvenement.getinstance();
        List<Evenement> evenements = service.getAllEvenements();
        DefaultListModel<Map<String, Object>> model = (DefaultListModel<Map<String, Object>>) eventList.getModel();
        model.removeAll();
        for (Evenement e : evenements) {
            Map<String, Object> item = new HashMap<>();
            item.put("Line1", "Titre : " + e.getTitre());
            item.put("Line2", "Type : " + e.getType());
            item.put("Line3", "Description : " + e.getDescription());
            item.put("Line4", "Adresse : " + e.getAdresse());
            item.put("Line5", "Date debut : " + e.getDate_debut());
            item.put("Line6", "Date fin : " + e.getDate_fin());
            item.put("Line7", e.getId());
            model.addItem(item);
        }
        eventList.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                try {
                    Map<String, Object> selectedItem = (Map<String, Object>) eventList.getSelectedItem();
                    int evenementId = (int) selectedItem.get("Line7");
                    Evenement selectedEvent = null;
                    for (Evenement e : evenements) {
                        if (e.getId()== evenementId) {
                            selectedEvent = e;
                            break;
                        }
                    }
                    EditFormEvenement myForm2 = new EditFormEvenement(selectedEvent);
                    myForm2.show();
                } catch (ParseException ex) {
                    System.out.println(ex);
                }
            }
        });

    }
 
}
