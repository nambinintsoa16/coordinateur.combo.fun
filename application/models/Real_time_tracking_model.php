<?php
class Real_time_tracking_model extends CI_Model
{
	public function __construct()
	{
	}

    public function getSaleByPage($month, $year) {
        $query = $this->db->query("
            SELECT 
                page_fb.Nom_page,
                SUM(prix.Prix_detail * detailvente.Quantite) AS Somme_Total
            FROM 
                Facture
            JOIN 
                detailvente ON Facture.id = detailvente.Facture
            JOIN 
                prix ON detailvente.id_prix = prix.id
            JOIN
                page_fb ON Facture.page = page_fb.id
            WHERE
                MONTH(Facture.Date) = ?
                AND YEAR(Facture.Date) = ?
            GROUP BY 
                page_fb.Nom_page
            ORDER BY 
                Somme_Total DESC
            LIMIT 15;
        ",  array($month, $year));
        $results = $query->result();
        return $results;
    }

    public function getSaleByOperatrice($month, $year) {
        $query = $this->db->query("
            SELECT 
                page_fb.operatrice,
                page_fb.Nom_operatrice,
                GROUP_CONCAT(DISTINCT CONCAT(page_fb.Nom_page, '\n')) AS Pages_utilisees,
                COUNT(DISTINCT page_fb.Nom_page) AS Nbr_page,
                SUM(prix.Prix_detail * detailvente.Quantite) AS Somme_Ventes
            FROM 
                Facture
            JOIN 
                detailvente ON Facture.id = detailvente.Facture
            JOIN 
                prix ON detailvente.id_prix = prix.id
            JOIN
                page_fb ON Facture.page = page_fb.id
            WHERE
                MONTH(Facture.Date) = ?
                AND YEAR(Facture.Date) = ?
            GROUP BY 
                page_fb.operatrice
            ORDER BY 
                Somme_Ventes DESC
        ", array($month, $year));
    
        $results = $query->result();
        return $results;
    }    

    public function getSaleByOperatricePerYear($month, $year, $operatrice) {
        $query = $this->db->query("
            SELECT 
                page_fb.operatrice,
                page_fb.Nom_operatrice,
                page_fb.Nom_page,
                SUM(prix.Prix_detail * detailvente.Quantite) AS Somme_Ventes_par_page
            FROM 
                Facture
            JOIN 
                detailvente ON Facture.id = detailvente.Facture
            JOIN 
                prix ON detailvente.id_prix = prix.id
            JOIN
                page_fb ON Facture.page = page_fb.id
            WHERE
                MONTH(Facture.Date) = ?
                AND YEAR(Facture.Date) = ?
                AND page_fb.operatrice = ?
            GROUP BY 
                page_fb.operatrice, page_fb.Nom_page
            ORDER BY 
                Somme_Ventes_par_page DESC
        ", array($month, $year, $operatrice));
    
        $results = $query->result();
        return $results;
    }
    
}