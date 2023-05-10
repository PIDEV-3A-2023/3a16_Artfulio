/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.entities;

import java.util.Date;

/**
 *
 * @author CALLO
 */
public class Artwork {
    private int id_artwork;
    private String nom_artwork;
    private String description_artwork;
    private int prix_artwork;
    private int id_type ;
    private Date date; 
    private int id_artist;
    private String lien_artwork;
    private int dimension_artwork;
    private String img_artwork;

    public Artwork(String nom_artwork, String description_artwork, int prix_artwork, int id_artist, String lien_artwork, String img_artwork) {
        this.nom_artwork = nom_artwork;
        this.description_artwork = description_artwork;
        this.prix_artwork = prix_artwork;
        this.id_artist = id_artist;
        this.lien_artwork = lien_artwork;
        this.img_artwork = img_artwork;
    }

    public Artwork() {
    }
     public Artwork(int id_artwork) {
        this.id_artwork = id_artwork;
    }

    public Artwork(int id_artwork, String nom_artwork) {
        this.id_artwork = id_artwork;
        this.nom_artwork = nom_artwork;
    }

    public Artwork(int id_artwork, String nom_artwork, String description_artwork, int prix_artwork, int id_type, Date date, int id_artist, String lien_artwork, int dimension_artwork, String img_artwork) {
        this.id_artwork = id_artwork;
        this.nom_artwork = nom_artwork;
        this.description_artwork = description_artwork;
        this.prix_artwork = prix_artwork;
        this.id_type = id_type;
        this.date = date;
        this.id_artist = id_artist;
        this.lien_artwork = lien_artwork;
        this.dimension_artwork = dimension_artwork;
        this.img_artwork = img_artwork;
    }

    public Artwork(int id_artwork, String nom_artwork, String description_artwork, int prix_artwork, String lien_artwork, int dimension_artwork, String img_artwork) {
        this.id_artwork = id_artwork;
        this.nom_artwork = nom_artwork;
        this.description_artwork = description_artwork;
        this.prix_artwork = prix_artwork;
        this.lien_artwork = lien_artwork;
        this.dimension_artwork = dimension_artwork;
        this.img_artwork = img_artwork;
    }

    public Artwork(String nom_artwork, String description_artwork, String img_artwork) {
        this.nom_artwork = nom_artwork;
        this.description_artwork = description_artwork;
        this.img_artwork = img_artwork;
    }

    public Artwork(String nom_artwork) {
        this.nom_artwork = nom_artwork;
    }
    

    public Artwork(String nom_artwork, String description_artwork, int prix_artwork, int id_type, Date date, int id_artist, String lien_artwork, int dimension_artwork, String img_artwork) {
        this.nom_artwork = nom_artwork;
        this.description_artwork = description_artwork;
        this.prix_artwork = prix_artwork;
        this.id_type = id_type;
        this.date = date;
        this.id_artist = id_artist;
        this.lien_artwork = lien_artwork;
        this.dimension_artwork = dimension_artwork;
        this.img_artwork = img_artwork;
    }

   

    public int getId_artwork() {
        return id_artwork;
    }

    public void setId_artwork(int id_artwork) {
        this.id_artwork = id_artwork;
    }

    public String getNom_artwork() {
        return nom_artwork;
    }

    public void setNom_artwork(String nom_artwork) {
        this.nom_artwork = nom_artwork;
    }

    public String getDescription_artwork() {
        return description_artwork;
    }

    public void setDescription_artwork(String description_artwork) {
        this.description_artwork = description_artwork;
    }

    public int getPrix_artwork() {
        return prix_artwork;
    }

    public void setPrix_artwork(int prix_artwork) {
        this.prix_artwork = prix_artwork;
    }

    public int getId_type() {
        return id_type;
    }

    public void setId_type(int id_type) {
        this.id_type = id_type;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public int getId_artist() {
        return id_artist;
    }

    public void setId_artist(int id_artist) {
        this.id_artist = id_artist;
    }

    public String getLien_artwork() {
        return lien_artwork;
    }

    public void setLien_artwork(String lien_artwork) {
        this.lien_artwork = lien_artwork;
    }

    public int getDimension_artwork() {
        return dimension_artwork;
    }

    public void setDimension_artwork(int dimension_artwork) {
        this.dimension_artwork = dimension_artwork;
    }

    public String getImg_artwork() {
        return img_artwork;
    }

    public void setImg_artwork(String img_artwork) {
        this.img_artwork = img_artwork;
    }


    @Override
    public boolean equals(Object obj) {
        if (this == obj) {
            return true;
        }
        if (obj == null) {
            return false;
        }
        if (getClass() != obj.getClass()) {
            return false;
        }
        final Artwork other = (Artwork) obj;
        if (this.id_artwork != other.id_artwork) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "artwork{" + "id_artwork=" + id_artwork + ", nom_artwork=" + nom_artwork + ", description_artwork=" + description_artwork + ", prix_artwork=" + prix_artwork + ", id_type=" + id_type + ", date=" + date + ", id_artist=" + id_artist + ", lien_artwork=" + lien_artwork + ", dimension_artwork=" + dimension_artwork + ", img_artwork=" + img_artwork + '}';
    }
    
    
    
    
    

    
}
