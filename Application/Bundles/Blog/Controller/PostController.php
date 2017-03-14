<?php

namespace Blog\Controller;

use Core\Controller;

class PostController extends Controller
{
    public $limit;

    public function __construct()
    {
        $this->limit = 10;
    }

    public function indexAction($offset = 0)
    {
        // List all posts
        // $posts = Get->post($offset, $limit, $search);
        return $this->render("Blog/Post/index.html.twig", [
            //"posts" => $posts,
            //"offset" => $offset, -- For pagination
            //"limit" => $this->limit -- For pagination
        ]);
    }

    public function viewAction($slug)
    {
        // If post exists -> View post by slug
        return $this->render("Blog/Post/view.html.twig", [
            //"post" => $post
        ]);
    }

    public function createAction()
    {
        // If (get) {show create form} elseif (post){ process form then redirect to show }
        return $this->render("Blog/Post/create.html.twig",[
            //"categories" => $categories
        ]);
    }

    public function updateAction($id)
    {
        // If (get) {show update form} elseif (post){ process form then redirect to show }
        return $this->render("Blog/Post/update.html.twig",[
            //"post" => $post,
            //"categories" => $categories
        ]);
    }
}