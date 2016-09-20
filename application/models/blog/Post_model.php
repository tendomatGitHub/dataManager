<?php

/**
 * Created by PhpStorm.
 * User: Godluck Akyoo
 * Date: 20-Jun-16
 * Time: 11:05
 */
class Post_model extends CI_Model
{
	private static $table_name = "blog_posts";
	private static $table_name_users = "users";

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param $post
	 * @return mixed
	 */
	public function create($post)
	{
		$this->db->insert(self::$table_name, $post);
		return $this->db->insert_id();
	}

	/**
	 * @param int $limit
	 * @param int $offset
	 * @return mixed
	 */
	public function find_all($limit = 30, $offset = 0)
	{
		$this->db->select("u.first_name,u.last_name,u.username,p.*");
		$this->db->from(self::$table_name." p");
		$this->db->join(self::$table_name_users." u","u.id = p.user_id");
		$this->db->limit($limit, $offset);
		$this->db->order_by("date_created", "DESC");
		return $this->db->get()->result();
	}

	/**
	 * @param $post_id
	 * @return string
	 */
	public function find_by_id($post_id)
	{
		$this->db->select("u.first_name,u.last_name,u.username,p.*");
		$this->db->from(self::$table_name." p");
		$this->db->join(self::$table_name_users." u","u.id = p.user_id");
		$this->db->where("p.id", $post_id);
		return $this->db->get()->row(1);
	}
	
	public function update($post_id, $updated_details)
	{
		$this->db->where("id", $post_id);
		$this->db->limit(1);
		return $this->db->update(self::$table_name, $updated_details);
	}
}