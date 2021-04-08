<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;




class storenews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Storing news';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $news = Http::get('https://newsapi.org/v2/everything?domains=goal.com&apiKey=9d1c8d817d6946d4959e0008bdc76da1')->json();
		 	 foreach ($news["articles"] as $key => $article) {
			 	  Article::firstOrCreate([
	        		'source'=>$article['source']['name'],
                    'author'=>$article['author'],
                    'title'=>$article['title'],
                    'description'=>$article['description'],
                    'url'=>$article['url'],
                    'imageurl'=>$article['urlToImage'],
                    'publishdate'=>$article['publishedAt'],
                    'content'=>$article['content']
                 ]);
         	}
    }
}
