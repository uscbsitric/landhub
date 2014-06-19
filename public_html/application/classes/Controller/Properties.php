<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Properties extends Lsp_Controller_Template
{
    public $template = 'templates/default';


    public function action_index()
    {
        $list = ORM::factory('Property')
            ->where('user_id', '=', $this->_user->id)
            ->find_all();

        $this->template->content = View::factory('html/properties/list')
            ->set('list', $list);
    }


    public function action_new()
    {
        $errors = array();

        $property_types = ORM::factory('Property_Type')
            ->where('is_archived', '=', 0)
            ->find_all();

        if ($this->request->method() == 'POST')
        {
            try
            {
                DB::query(null, 'start transaction')->execute();

                $property = ORM::factory('Property')->values($_POST, array(
                    'property_type_id',
                    'title',
                    'description',
                    'price',
                    'acres',
                    'company_name',
                    'contact_name',
                    'contact_email',
                    'contact_phone',
                    'mls_id',
                    'mls_url',
                    'school_district',
                    'subdivision',
                    'address',
                    'zip_code',
                    'beds',
                    'baths',
                    'sqft',
                    'levels',
                    'has_garage',
                    'notes',
                    'date_created',
                ));

                if (sizeof($_FILES))
                {
                    $property->validate_photos($_FILES['photos']);
                }

                $property->user_id = $this->_user->id;
                $property->slug = URL::title($property->title);
                $property->date_created = DB::expr('now()');
                $property->last_updated = DB::expr('now()');
                $property->save();

                if (sizeof($_FILES))
                {
                    $property->add_photos($_FILES['photos']);
                }

                DB::query(null, 'commit')->execute();
                HTTP::redirect('/properties/index/', 302);
                //$this->redirect('/properties');
                /*
                $this->redirect($this->request->uri(array('controller' => 'Properties',
									                	  'action'     => 'index'
									                	 )
									               )
							   );
				*/
                exit();
            }
            catch(ORM_Validation_Exception $e)
            {
                DB::query(null, 'rollback')->execute();
                $errors = $e->errors('model');
            }
            catch(Exception $e)
            {
                DB::query(null, 'rollback')->execute();
                $errors = array('exception' => $e->getMessage());
            }
        }

        $this->template->content = View::factory('html/properties/new')
            ->set('property_types', $property_types)
            ->set('errors', $errors);
    }


    public function action_edit()
    {
        $errors = array();

        $property_types = ORM::factory('Property_Type')
            ->where('is_archived', '=', 0)
            ->find_all();

        $id = $this->request->param('id');

        $item = ORM::factory('Property')
            ->where('id', '=', $id)
            ->where('user_id', '=', $this->_user->id)
            ->find();

        if (!$item->loaded()) throw new HTTP_Exception_404('No such property');

        if ($this->request->method() == 'POST')
        {
            try
            {
                DB::query(null, 'start transaction')->execute();

                $item->values($_POST, array(
                    'property_type_id',
                    'title',
                    'description',
                    'price',
                    'acres',
                    'company_name',
                    'contact_name',
                    'contact_email',
                    'contact_phone',
                    'mls_id',
                    'mls_url',
                    'school_district',
                    'subdivision',
                    'address',
                    'zip_code',
                    'beds',
                    'baths',
                    'sqft',
                    'levels',
                    'has_garage',
                    'notes',
                    'last_updated',
                    'is_archived',
                ));

                if (sizeof($_FILES))
                {
                    $item->validate_photos($_FILES['photos']);
                }

                $item->slug = URL::title($item->title);
                $item->last_updated = DB::expr('now()');
                $item->update();

                if (sizeof($_FILES))
                {
                    $item->add_photos($_FILES['photos']);
                }

                DB::query(null, 'commit')->execute();

                $this->redirect('/properties');
                exit();
            }
            catch(ORM_Validation_Exception $e)
            {
                DB::query(null, 'rollback')->execute();
                $errors = $e->errors('model');
            }
            catch(FormFieldCollection_Exception $e)
            {
                DB::query(null, 'rollback')->execute();
                $errors = $e->errors();
            }
        }

        foreach($item->as_array() as $key=>$val)
        {
            $_POST[$key] = $val;
        }

        $photos = $item->photos->where('is_archived', '=', 0)->find_all();

        $this->template->content = View::factory('html/properties/edit')
            ->set('id', $id)
            ->set('remaining', $item->num_photos_remaining())
            ->set('property_types', $property_types)
            ->set('photos', $photos)
            ->set('errors', $errors);
    }


    public function action_archive()
    {
        $id = $this->request->param('id');

        $item = ORM::factory('Property')
            ->where('id', '=', $id)
            ->where('user_id', '=', $this->_user->id)
            ->find();

        $item->is_archived = 1;
        $item->update();

        $this->redirect('/properties');
        exit();
    }


    public function action_activate()
    {
        $id = $this->request->param('id');

        $item = ORM::factory('Property')
            ->where('id', '=', $id)
            ->where('user_id', '=', $this->_user->id)
            ->find();

        $item->is_archived = 0;
        $item->update();

        $this->redirect('/properties');
        exit();
    }


    /**Author: Frederick Sandalo
     * Method: action_migrate
     * Purpose: migrates database table data from rural_rural.
     **/
	public function action_migrate()
	{
		$dbName = 'data_synd_platform';
		$sourceDb = 'rural_rural';

		try
		{
			DB::query(null, 'start transaction')->execute();

			$targetColumns = $this->getPropertiesTableColumns();
			$sourceTable = 'items';
			$sourceColumns = $this->getSourceTableColumns($sourceDb, $sourceTable);
			$targetTable = '`data_synd_platform`.`properties`';
			$sourceTable = '`rural_rural`.`items`';
			$transferResult = $this->transferSourceTableToTargetTable($dbName, $targetColumns, $sourceColumns, $targetTable, $sourceTable);
		}
		catch(ORM_Validation_Exception $e)
		{
			DB::query(null, 'rollback')->execute();
			$errors = $e->errors('model');
		}
		catch(Exception $e)
		{
			DB::query(null, 'rollback')->execute();
			$errors = array('exception' => $e->getMessage());
		}
		
		try
		{
			DB::query(null, 'start transaction')->execute();

			$targetColumns = $this->getPropertyPhotosTableColumns($dbName);
			$sourceTable = 'photos';
			$targetTable = '`data_synd_platform`.`property_photos`';
			$sourceColumns = $this->getSourceTableColumns($sourceDb, $sourceTable);
			$sourceTable = '`rural_rural`.`photos`';
			$transferResult = $this->transferSourceTableToTargetTable($dbName, $targetColumns, $sourceColumns, $targetTable, $sourceTable);
			$imagePathColumn = 'url';
		    $imageUploadPath = '/media/uploads/';
		    $this->appendUploadsDirPath($dbName, $imagePathColumn, $imageUploadPath, $targetTable);
		}
		catch(ORM_Validation_Exception $e)
		{
			DB::query(null, 'rollback')->execute();
			$errors = $e->errors('model');
		}
		catch(Exception $e)
		{
			DB::query(null, 'rollback')->execute();
			$errors = array('exception' => $e->getMessage());
		}

		try
		{
			DB::query(null, 'start transaction')->execute();

			$targetColumns = $this->getUsersTableColumns();
			$sourceTable = 'members';
			$targetTable = '`data_synd_platform`.`users`';
			$sourceColumns = $this->getSourceTableColumns($sourceDb, $sourceTable);
			$sourceTable = '`rural_rural`.`members`';
			DB::query(null, "CREATE TEMPORARY TABLE `rural_rural`.`dummyMembers` LIKE $sourceTable;")->execute();
			DB::query(Database::INSERT, "INSERT INTO `rural_rural`.`dummyMembers` SELECT * FROM $sourceTable;")->execute();
			DB::query(null, "ALTER table `rural_rural`.`dummyMembers` CHANGE COLUMN last_login last_login varchar(50)")->execute();
			DB::query(Database::UPDATE, "UPDATE `rural_rural`.`dummyMembers` SET `last_login` = '0000-00-00' WHERE `last_login` IS NULL")->execute();
			DB::query(Database::UPDATE, "UPDATE `rural_rural`.`dummyMembers` SET `last_login` = UNIX_TIMESTAMP(`last_login`)")->execute();
			DB::query(null, "ALTER table `rural_rural`.`dummyMembers` CHANGE COLUMN last_login last_login int(10)")->execute();
			$sourceTable = '`rural_rural`.`dummyMembers`';
			$transferResult = $this->transferSourceTableToTargetTable($dbName, $targetColumns, $sourceColumns, $targetTable, $sourceTable);
		}
		catch(ORM_Validation_Exception $e)
		{
			DB::query(null, 'rollback')->execute();
			$errors = $e->errors('model');
		}
		catch(Exception $e)
		{
			DB::query(null, 'rollback')->execute();
			$errors = array('exception' => $e->getMessage());
		}
		
		$this->template->content = View::factory('html/properties/migrate')
										 ->set('migrationMessage', 'Migration of rural_rural.items to data_synd_platform and rural_rural.photos to data_synd_platform.property_photos complete');
	}


	function transferSourceTableToTargetTable($dbname, $targetColumns = null, $sourceColumns = null, $targetTable, $sourceTable)
	{
		$this->changeFromNullToEmptyString($sourceColumns, $sourceTable);

		$query = 'SET FOREIGN_KEY_CHECKS = 0;';
		DB::query(null, $query)->execute();

		$query = 'INSERT IGNORE INTO '.$targetTable.'(`'. implode("`,`", $targetColumns) .'`)
				  SELECT `'. implode("`,`", $sourceColumns) .'` FROM '.$sourceTable.';
				 ';
		$queryResult = DB::query(Database::INSERT, $query)->execute();

		$query = 'SET FOREIGN_KEY_CHECKS = 1;';
		DB::query(null, $query)->execute();
	}


	function appendUploadsDirPath($dbname, $imagePathColumn, $imageUploadPath, $tableName)
	{
		$query = 'UPDATE '.$tableName.' set '.$imagePathColumn.' = CONCAT("'.$imageUploadPath.'", url)';
		$queryResult = DB::query(Database::UPDATE, $query)->execute();
	}


	function changeFromNullToEmptyString($sourceColumns, $sourceTable)
	{
		$column = '';
	
		foreach($sourceColumns as $sourceColumn)
		{
			$column = '`' .$sourceColumn. '`';
			$query  = "UPDATE $sourceTable SET $column = 0 WHERE $column is null";
			$queryResult = DB::query(Database::UPDATE, $query)->execute();
		}
	}


	function getPropertiesTableColumns()
	{
		// since the target table 'data_synd_platform.properties' has more columns than subject table 'rural_rural.items', they dont get matched up automatically,
		// so we have to specify what columns it will be matched up with the subject table
		$targetColumns = array('id', 'cid', 'title', 'price', 'pdate', 'sold', 'description', 'address', 'city', 'state', 'zip_code',
							   'featured', 'active', 'hits', 'beds', 'baths', 'subdivision', 'school_district', 'year_built', 'acres',
							   'sqft', 'lat', 'long', 'show_cities', 'company_name', 'contact_name', 'contact_phone', 'contact_email',
							   'users_id', 'notes', 'expires', 'style_id', 'has_garage', 'levels', 'testimonial', 'county', 'sale_price',
							   'mls_id', 'photo_limit', 'credit_id', 'mls_url', 'status', 'private_financing', 'fsbo', 'region', 'slug'
							 );

		return $targetColumns;
	}


	function getSourceTableColumns($dbname, $tablename)
	{
		$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS  WHERE TABLE_SCHEMA='$dbname' AND TABLE_NAME= '$tablename' ";
		$queryResults = DB::query(Database::SELECT, $query)->execute();

		$sourceColumns = array();

		foreach($queryResults as $queryResult)
		{
			$sourceColumns[] = $queryResult['COLUMN_NAME'];
		}

		return $sourceColumns;
	}


	function getPropertyPhotosTableColumns($dbname)
	{

		$targetColumns = array('id', 'ptype', 'property_id', 'caption', 'porder', 'url');

		return $targetColumns;
	}


	function getUsersTableColumns()
	{
		$targetColumns = array('id', 'name', 'address', 'city', 'state', 'zip', 'active',
							   'last_login', 'membership', 'email', 'password', 'phone', 'created',
							   'realtor', 'company', 'website', 'emailNotify', 'subscription_type'
							  );
		
		return $targetColumns;
	}


	public function action_hashThePasswords()
	{
		// hash_hmac($this->_config['hash_method'], $str, $this->_config['hash_key']);
		//var_dump( hash_hmac('sha256', 'password123', 'b315$4acfaa3a417007ad11bdb5fff308732f@679a#1919z716a02') );
		//exit();

		/*****
		$connection = mysqli_connect('localhost', 'lhstage', 'landhub$55', 'data_synd_platform');
		
		$query = 'select id, password from users';
		$result = mysqli_query($connection, $query);
		
		
		while($row = mysqli_fetch_assoc($result))
		{
			if($row['id'] > 4)
			{
				$newValue = hash_hmac('sha256', $row['password'], 'b315$4acfaa3a417007ad11bdb5fff308732f@679a#1919z716a02');
				$query = "update data_synd_platform.users set password='$newValue' where id=".$row['id']."";
				$queryResult = mysqli_query($connection, $query);
			}
		}
		
		exit();
		*****/
	}


}