    package tn.gestion.artfulio.entites;

public class Categorie {
    private int id;
    private String type ;
    private String nom;

    public Categorie() {
    }

    public Categorie(int id, String name, String type) {
        this.id = id;
        this.nom = name;
        this.type = type;
    }
    
    public Categorie(String name, String type) {
        this.nom = name;
        this.type = type;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getName() {
        return nom;
    }

    public void setName(String name) {
        this.nom = name;
    }

    public String getType() {
        return type;
    }

    public void setType(String Type) {
        this.type = Type;
    }

    @Override
    public String toString() {
        return "Categorie{" + "id=" + id + ", name=" + nom + ", type=" + type + '}';
    }

}
