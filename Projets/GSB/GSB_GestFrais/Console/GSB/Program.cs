using GSBFraisModel.Data;
using GSBFraisModel.Buisness;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace GSB
{
    class Program
    {
        static void Main(string[] args)
        {
            Dbal myDbal = new Dbal("gsb_gestfrais");
            //myDbal.CUDQuery("INSERT INTO source Values(2,'marmiton','url.example')");
            //myDbal.Delete("source where id = 2");
            //DataTable datas = new DataTable();
            //datas = myDbal.SelectAll("visiteur");
            //Console.WriteLine(datas.Rows[0].ItemArray[0].ToString() + " | " + datas.Rows[0].ItemArray[1].ToString());
            //Console.Read();
            DaoVisiteur monDao = new DaoVisiteur(myDbal);
            Visiteurs unVisiteur = new Visiteurs("a130", "bob", "bob", "bob");
        }
    }
}
