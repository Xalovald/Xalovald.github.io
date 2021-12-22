using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace GSBFraisModel.Data
{
    
    public class Dbal
    {

        MySqlConnection conn;
        public Dbal(string database, string uid = "root", string password = "root", string server = "localhost")
        {
            Initialize(database, uid, password, server);
        }
        private void Initialize(string database, string uid, string password, string server)
        {
            string connStr = "server=" + server + ";" + "database=" +
            database + ";" + "uid=" + uid + ";" + "password=" + password + ";";
            conn = new MySqlConnection(connStr);
        }

        private bool OpenConnection()
        {
            try
            {
                Console.WriteLine("Connecting to MySQL...");
                conn.Open();
                // Perform database operations
                return true;
            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.ToString());
            }
            return false;
        }
        private bool CloseConnection()
        {
            try
            {
                Console.WriteLine("Closing connection...");
                conn.Close();
                // Perform database operations
                return true;
            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.ToString());
            }
            return false;
        }

        public void CUDQuery(string query)
        {
            if (this.OpenConnection() == true)
            {
                MySqlCommand cmd = new MySqlCommand(query, conn);

                cmd.ExecuteNonQuery();

                CloseConnection();
            }
           
        }
        //Insert 
        public void Insert(string query)
        {
            query = "INSERT INTO " + query; //tablename (field, field2) VALUES('value 1', 'value 2')";
            CUDQuery(query);

        }

        //Update statement

        public void Update(string query)
        {
            query = "UPDATE " + query;

            CUDQuery(query);
        }

        //Delete statement
        public void Delete(string query)
        {
            query = "DELETE FROM " + query;

            CUDQuery(query);
        }

        //RQuery, read query method (to execurte SELECT queries)
        private DataSet RQuery(string query)
        {
            DataSet dataset = new DataSet();
            //open connection
            if (this.OpenConnection() == true)
            {
                //Add query data in a DataSet
                MySqlDataAdapter adapter = new MySqlDataAdapter(query, conn);
                adapter.Fill(dataset);
                CloseConnection();
            }
            return dataset;
        }

        //SELECT a table from database
        public DataTable SelectAll(string table)
        {
            string query = "SELECT * FROM " + table;
            DataSet dataset = RQuery(query);

            return dataset.Tables[0];

        }

        public DataRow SelectById(string table, string id)
        {
            string query = "SELECT * FROM " + table + "where id ='" + id + "'";
            DataSet dataset = RQuery(query);

            return dataset.Tables[0].Rows[0];
        }

        public DataTable SelectByField(string table, string fieldTestCondition)
        {
            string query = "SELECT * FROM " + table + " where " + fieldTestCondition;
            DataSet dataset = RQuery(query);

            return dataset.Tables[0];
        }
    }
}
