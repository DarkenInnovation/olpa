<?php
    class Article_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }
        public function get_posts($slug = FALSE) {
            if($slug === FALSE) {
                $this->db->order_by('article.id', 'DESC');
                $this->db->join('article_categories', 'article_categories.id = article.category_id');

                $query = $this->db->get('article');
                return $query->result_array();

            }

            $query = $this->db->get_where('article', array('slug' => $slug));
            return $query->row_array();
        }
        public function get_categories(){
            $this->db->order_by('name');
            $query = $this->db->get('article_categories');
            return $query->result_array();
        }

        public function create_post($post_image) {
            $slug = url_title($this->input->post('title'));
            $data = array(
                'title' => $this->input->post('title'),
                'author' => $this->input->post('author'),
                'tags' => $this->input->post('tags'),
                'slug' => $slug,
                'body' => $this->input->post('body'),
                'category_id' => $this->input->post('category_id'),
                'article_image' => $post_image,
                'status' => 'Active'
            );

            return $this->db->insert('article', $data);

        }

        public function update_post($post_image) {
            $slug = url_title($this->input->post('title'));
            $data = array(
                'title' => $this->input->post('title'),
                'author' => $this->input->post('author'),
                'tags' => $this->input->post('tags'),
                'slug' => $slug,
                'body' => $this->input->post('body'),
                'category_id' => $this->input->post('category_id'),
                'article_image' => $post_image
            );

            $this->db->where('id', $this->input->post('id'));
            return $this->db->update('article', $data);

        }
    }