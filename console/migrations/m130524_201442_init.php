<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->execute("
        
        CREATE TABLE `Product` (
          `id` int(10) NOT NULL,
          `product_id` bigint(20) NOT NULL,
          `title` varchar(255) DEFAULT NULL,
          `description` text,
          `rating` float(6,1) DEFAULT NULL,
          `price` double DEFAULT NULL,
          `image` varchar(255) DEFAULT NULL,
          `views` int(10) NOT NULL DEFAULT '0'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        
        ALTER TABLE `Product`  ADD PRIMARY KEY (`id`);
  
        ALTER TABLE `Product`  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
        
        ");



    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%Product}}');
    }
}
