/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.entities;

/**
 *
 * @author Asus
 */
public class Store {
    private int id_produit,id_piece_art;
    private String nom_artwork,img_artwork;
    private float prix_artwork;

    public Store() {
    }

    public Store(int id_produit, int id_piece_art, String nom_artwork, String img_artwork, float prix_artwork) {
        this.id_produit = id_produit;
        this.id_piece_art = id_piece_art;
        this.nom_artwork = nom_artwork;
        this.img_artwork = img_artwork;
        this.prix_artwork = prix_artwork;
    }

    public Store(int id_piece_art, String nom_artwork, String img_artwork, float prix_artwork) {
        this.id_piece_art = id_piece_art;
        this.nom_artwork = nom_artwork;
        this.img_artwork = img_artwork;
        this.prix_artwork = prix_artwork;
    }

    public int getId_produit() {
        return id_produit;
    }

    public void setId_produit(int id_produit) {
        this.id_produit = id_produit;
    }

    public int getId_piece_art() {
        return id_piece_art;
    }

    public void setId_piece_art(int id_piece_art) {
        this.id_piece_art = id_piece_art;
    }

    public String getNom_artwork() {
        return nom_artwork;
    }

    public void setNom_artwork(String nom_artwork) {
        this.nom_artwork = nom_artwork;
    }

    public String getImg_artwork() {
        return img_artwork;
    }

    public void setImg_artwork(String img_artwork) {
        this.img_artwork = img_artwork;
    }

    public float getPrix_artwork() {
        return prix_artwork;
    }

    public void setPrix_artwork(float prix_artwork) {
        this.prix_artwork = prix_artwork;
    }

    @Override
    public String toString() {
        return "Store{" + "id_produit=" + id_produit + ", id_piece_art=" + id_piece_art + ", nom_artwork=" + nom_artwork + ", img_artwork=" + img_artwork + ", prix_artwork=" + prix_artwork + '}';
    }
    
    
    
    
}
