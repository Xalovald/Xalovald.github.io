using GSBFraisModel.Buisness;
using System;
using System.Collections.Generic;
using System.Data;
using System.Globalization;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace GSBFraisModel.Data
{
    public class DaoVisiteur
    {
        private Dbal _dbal;

        public DaoVisiteur(Dbal mydbal)
        {
            this._dbal = mydbal;
        }

        public void Insert(Visiteurs unVisiteur)
        {
            string query = "visiteur (id, nom, prenom, login) VALUES (" + unVisiteur.Id + ",'" + unVisiteur.Nom.Replace("'", "''") + ",'" + unVisiteur.Prenom.Replace("'", "''") + ",'" + unVisiteur.Login + "')";
            this._dbal.Insert(query);
        }

        public void Delete(Visiteurs unVisiteur)
        {
            string query = "visiteur where id =" + unVisiteur.Id;
            this._dbal.Delete(query);
        }

        public void Update(Visiteurs unVisiteur)
        {
            string query = "visiteur SET " + "nom = '" + unVisiteur.Nom.Replace("'", "''") + "' , prenom = '" + unVisiteur.Prenom.Replace("'", "''") + "' , login = '" + unVisiteur.Login;
            this._dbal.Update(query);
        }

        public List<Visiteurs> SelectAll()
        {
            List<Visiteurs> listeVisiteurs = new List<Visiteurs>();
            DataTable maTable = this._dbal.SelectAll("visiteur");
            foreach (DataRow r in maTable.Rows)
            {
                listeVisiteurs.Add(new Visiteurs((string)r["id"], (string)r["nom"], (string)r["prenom"], (string)r["login"]));
            }
            return listeVisiteurs;
        }

        public Visiteurs SelectByName(string nomVisiteurs)
        {
            DataTable resultat = new DataTable();
            resultat = this._dbal.SelectByField("visiteur", "nom = '" + nomVisiteurs.Replace("'", "''") + "'");
            Visiteurs trouveVisiteur = new Visiteurs((string)resultat.Rows[0]["id"], (string)resultat.Rows[0]["nom"],(string)resultat.Rows[0]["prenom"], (string)resultat.Rows[0]["login"]);
            return trouveVisiteur;
        }
        public Visiteurs SelectById(string idVisiteurs)
        {
            DataRow resultat = this._dbal.SelectById("visiteur", idVisiteurs);
            return new Visiteurs((string)resultat["id"], (string)resultat["nom"],(string)resultat["prenom"], (string)resultat["login"]);
        }

    }
}
