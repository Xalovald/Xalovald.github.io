using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace GSBFraisModel.Buisness
{
    class FicheFrais
    {
        private Visiteurs unVisiteur;
        private string _mois;
        private Etat unEtat;
        private decimal _MontantValide;
        private int _nbjustificatif;
        private DateTime _dateModif;

        internal Visiteurs UnVisiteur
        {
            get
            {
                return unVisiteur;
            }

            set
            {
                unVisiteur = value;
            }
        }

        public string Mois
        {
            get
            {
                return _mois;
            }

            set
            {
                _mois = value;
            }
        }

        internal Etat UnEtat
        {
            get
            {
                return unEtat;
            }

            set
            {
                unEtat = value;
            }
        }

        public decimal MontantValide
        {
            get
            {
                return _MontantValide;
            }

            set
            {
                _MontantValide = value;
            }
        }

        public int Nbjustificatif
        {
            get
            {
                return _nbjustificatif;
            }

            set
            {
                _nbjustificatif = value;
            }
        }

        public DateTime DateModif
        {
            get
            {
                return _dateModif;
            }

            set
            {
                _dateModif = value;
            }
        }
    }
}
