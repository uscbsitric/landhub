<?php defined('SYSPATH') or die('No direct script access.');

class Model_Property extends ORM
{
    protected $_table_name = 'properties';

    protected $_belongs_to = array('user' => array('model' 		 => 'User',
            									   'foreign_key' => 'user_id',
        										  ),
							       'property_type' => array('model' 	  => 'Property_Type',
							            				    'foreign_key' => 'property_type_id',
							        					   )
    							  );

    protected $_has_many = array('photos' => array('model' 		 => 'Property_Photo',
            									   'foreign_key' => 'property_id',
        										  )
    							);

    public function rules()
    {
        return array(
            'user_id' => array(
                array('not_empty'),
                array('digit'),
            ),
            'property_type_id' => array(
                array('not_empty'),
                array('digit'),
            ),
            'user_id' => array(
                array('not_empty'),
                array('digit'),
            ),
            'title' => array(
                array('not_empty'),
                array('min_length', array(':value', 2)),
                array('max_length', array(':value', 64)),
            ),
            'slug' => array(
                array('not_empty'),
                array('min_length', array(':value', 2)),
                array('max_length', array(':value', 255)),
            ),
            'description' => array(
                array('not_empty'),
                array('min_length', array(':value', 2)),
                array('max_length', array(':value', 3000)),
            ),
            'price' => array(
                array('not_empty'),
                array('digit'),
            ),
            'acres' => array(
                array('not_empty'),
                array('numeric'),
            ),
            'company_name' => array(
                array('min_length', array(':value', 2)),
                array('max_length', array(':value', 64)),
            ),
            'contact_name' => array(
                array('not_empty'),
                array('min_length', array(':value', 2)),
                array('max_length', array(':value', 64)),
            ),
            'contact_email' => array(
                array('not_empty'),
                array('email'),
            ),
            'contact_phone' => array(
                array('not_empty'),
                array('exact_length', array(':value', 10)),
            ),
            'zip_code' => array(
                array('not_empty'),
                array('exact_length', array(':value', 5)),
                array('digit'),
            ),
            'beds' => array(
                array('numeric'),
            ),
            'baths' => array(
                array('numeric'),
            ),
            'year_built' => array(
                //array('exact_length', array(':value', 4)),
                //array('digit'),
            ),
            'levels' => array(
                array('numeric'),
            ),
        );
    }

    public function num_photos()
    {
        return $this->photos->find_all()->count();
    }

    public function num_photos_remaining()
    {
        return (12-($this->num_photos()));
    }

    public function validate_photos($images)
    {
        if (!is_array($images['name']))
        {
            // normalize to work like a multiple image upload (we just want one process)
            $tmp = array();
            foreach($images as $key=>&$val)
            {
                $tmp[$key] = array();
                $tmp[$key][] = $val;
            }
            $images = $tmp;
        }

        $num_remaining = $this->num_photos_remaining();

        if (sizeof($images['name']) > $num_remaining)
            throw new Exception('You may only upload up to '.$num_remaining.' photos');

        $valid_mime_types = array('image/png', 'image/jpg', 'image/gif', 'image/jpeg');

        foreach($images['type'] as $type)
        {
            if (!in_array($type, $valid_mime_types))
            {
                throw new Exception('Invalid image type; must be JPG, GIF, or PNG');
            }
        }

        foreach($images['size'] as $size)
        {
            if ($size > 6291456)
            {
                throw new Exception('Photo must be less than 6291456 bytes');
            }
        }

        foreach($images['error'] as $error)
        {
            if ($error != 0)
            {
                throw new Exception('Unknown error while uploading photo');
            }
        }
    }

    public function add_photos($images)
    {
        if (!is_array($images['name']))
        {
            // normalize to work like a multiple image upload (we just want one process)
            $tmp = array();
            foreach($images as $key=>&$val)
            {
                $tmp[$key] = array();
                $tmp[$key][] = $val;
            }
            $images = $tmp;
        }
        
        try
        {
            for($i=0; $i < sizeof($images['name']); $i++)
            {
                $ext = preg_replace('/^.*\./', '', $images['name'][$i]);
                $tmp = $images['tmp_name'][$i];
                $file_hash = sha1(strtotime('now').$images['name'][$i]).'.'.$ext;
                $md5_hash = md5(file_get_contents($tmp));

                move_uploaded_file($tmp, DOCROOT.'media/uploads/'.$file_hash);

                $item['md5'] = $md5_hash;
                $item['file'] = '/media/uploads/'.$file_hash;
                $list[] = $item;
            }

            foreach($list as $photo)
            {
                $img = ORM::factory('Property_Photo');
                $img->property_id = $this->id;
                $img->url = $photo['file'];
                $img->md5_hash = $photo['md5'];
                $img->date_created = DB::expr('now()');
                $img->is_archived = 0;
                $img->save();
            }
        }
        catch(Exception $e)
        {
            throw new Exception('Unable to upload photos');
        }
    }
}