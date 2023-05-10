/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tn.artfulio.entities;

import java.util.Date;

/**
 *
 * @author lelou
 */
public class Evenement {
     private int id;

    private String titre;
    private String type;
    private String description;
    private String adresse;
    private Date date_debut;
    private Date date_fin;
    private String image;

    public Evenement(int id, String titre, String type, String description, String adresse, Date date_debut, Date date_fin, String image) {
        this.id = id;
        this.titre = titre;
        this.type = type;
        this.description = description;
        this.adresse = adresse;
        this.date_debut = date_debut;
        this.date_fin = date_fin;
        this.image = image;
    }
    
    

    public Evenement(String titre, String type, String description, String adresse, Date date_debut, Date date_fin) {
        this.titre = titre;
        this.type = type;
        this.description = description;
        this.adresse = adresse;
        this.date_debut = date_debut;
        this.date_fin = date_fin;
    }

    public Evenement() {
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getId() {
        return id;
    }
    public String getTitre() {
        return titre;
    }

    public String getType() {
        return type;
    }

    public String getDescription() {
        return description;
    }

    public String getAdresse() {
        return adresse;
    }

    public Date getDate_debut() {
        return date_debut;
    }

    public Date getDate_fin() {
        return date_fin;
    }

    public String getImage() {
        return image;
    }

    public void setTitre(String titre) {
        this.titre = titre;
    }

    public void setType(String type) {
        this.type = type;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public void setAdresse(String adresse) {
        this.adresse = adresse;
    }

    public void setDate_debut(Date date_debut) {
        this.date_debut = date_debut;
    }

    public void setDate_fin(Date date_fin) {
        this.date_fin = date_fin;
    }

    public void setImage(String image) {
        this.image = image;
    }

    @Override
    public String toString() {
        return "Evenement{" + "titre=" + titre + ", type=" + type + ", description=" + description + ", adresse=" + adresse + ", date_debut=" + date_debut + ", date_fin=" + date_fin + '}';
    }
    
}
