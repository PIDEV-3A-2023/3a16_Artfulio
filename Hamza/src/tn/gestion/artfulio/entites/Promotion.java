    package tn.gestion.artfulio.entites;

public class Promotion {
    private int id;
    private int remise ;
    private String type;
    private String nom_artwork;
    private String prix_artwork;
    private int id_artwork;

    public Promotion(int id, int remise, String type, String nom_artwork, String prix_artwork, int id_artwork) {
        this.id = id;
        this.remise = remise;
        this.type = type;
        this.nom_artwork = nom_artwork;
        this.prix_artwork = prix_artwork;
        this.id_artwork = id_artwork;
    }

    public Promotion() {
    }

    public Promotion(int remise, String type, String nom_artwork, String prix_artwork, int id_artwork) {
        this.remise = remise;
        this.type = type;
        this.nom_artwork = nom_artwork;
        this.prix_artwork = prix_artwork;
        this.id_artwork = id_artwork;
    }

    public Promotion(int id, int remise, String type, String nom_artwork, String prix_artwork) {
        this.id = id;
        this.remise = remise;
        this.type = type;
        this.nom_artwork = nom_artwork;
        this.prix_artwork = prix_artwork;
    }
    
    

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getRemise() {
        return remise;
    }

    public void setRemise(int remise) {
        this.remise = remise;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public String getNom_artwork() {
        return nom_artwork;
    }

    public void setNom_artwork(String nom_artwork) {
        this.nom_artwork = nom_artwork;
    }

    public String getPrix_artwork() {
        return prix_artwork;
    }

    public void setPrix_artwork(String prix_artwork) {
        this.prix_artwork = prix_artwork;
    }

    public int getId_artwork() {
        return id_artwork;
    }

    public void setId_artwork(int id_artwork) {
        this.id_artwork = id_artwork;
    }

    
}
