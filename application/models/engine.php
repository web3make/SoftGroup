<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Engine extends CI_Model
{
	function __construct(){
		parent::__construct();
	}

	public function get_categories(){
		$this->db->select('category, title');
		$this->db->from("categories");
		$this->db->where("activated","a");
		return $this->db->get()->result();
	}
	public function get_last_news(){
		return $this->db->select('id,title')->order_by('id DESC')->get('news', 5, 0)->result();
	}

	public function get_promo(){
		return $this->db->order_by('id DESC')->get('promo')->result();
	}
	public function get_hero(){
		return $this->db->select('contact,name')->order_by('rank DESC')->get('contacts')->result();
	}

	public function get_allhero(){
		return $this->db->select('contact,name,about,slogan,email,photo,soc_fb,soc_gp,soc_tw,soc_in')->order_by('rank DESC')->get('contacts')->result();
	}

	public function get_person($person){
		return $this->db->get_where('contacts',array('contact'=>$person))->row();
	}

	public function default_engine(){
		return $this->db->get('default_engine')->row();
	}
	
	function news_pagination($id = 0, $num=0){
		return $this->db->select('id,title,create,descript')->order_by('id DESC')->get('news', $num, $id)->result();
	}
	function blog_pagination($id = 0, $num=0){
		return $this->db->select('id,category,title,create,descript,photo')->order_by('id DESC')->get('articles', $num, $id)->result();
	}

	function category_pagination($cat="", $id = 0, $num=0){
		return $this->db->select('id,category,title,create,descript,photo')->order_by('id DESC')->get_where('articles', array('category'=>$cat), $num, $id)->result();
	}
	function get_new($id){
//				$array = array('id_user' => $id);
//		return $this->db->get_where('users',$array)->row(
		return $this->db->get_where('news',array('id'=>$id))->row();
	}

	function get_article($id){
		return $this->db->get_where('articles',array('id'=>$id))->row();
	}

	function get_user($id){
		return $this->db->select('user_name')->get_where('users',array('id_user'=>$id))->row();
	}
//-----------------------------
    public function pagination($id = 0, $num = 0)
    {
        $str = "SELECT 
                	a.id_article,
                	a.title,
                	a.text,
                    a.id_category,
                	DATE(a.date) AS `date`,
                	COUNT(c.id_comment) AS `comments`,
                    cat.title as `category`
                    
                FROM articles AS a
                
                	LEFT JOIN comments AS c
                	ON c.id_article = a.id_article
                    
                    LEFT JOIN categories AS cat
                	ON cat.id_category = a.id_category
                    
                GROUP BY a.id_article
                ORDER BY a.id_article DESC
                LIMIT $id,$num";
        return $this->db->query($str)->result();
    }
//-----------------------------
}