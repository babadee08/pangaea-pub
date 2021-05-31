<?php

namespace Database\Seeders;

use Database\Factories\TopicFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private TopicFactory $topicFactory;

    public function __construct(TopicFactory $topicFactory)
    {
        $this->topicFactory = $topicFactory;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        $this->topicFactory->create([
            'name' => 'topic1'
        ]);
    }
}
