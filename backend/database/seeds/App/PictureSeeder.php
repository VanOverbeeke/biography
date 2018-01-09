<?php

use Illuminate\Database\Seeder;

use App\Models\Picture;

class PictureSeeder extends Seeder
{
    public function run()
    {
        Picture::firstOrCreate([
            "path" => "http://i.dailymail.co.uk/i/pix/2014/05/07/article-2622664-1DA6304A00000578-923_634x380.jpg",
            "imageable_id" => 1,
            "imageable_type" => "App\Models\Genus",]);
        Picture::firstOrCreate([
            "path" => "http://slideplayer.com/slide/4889477/16/images/3/LE+25-9+Panthera+pardus+(leopard)+Mephitis+mephitis+(striped+skunk).jpg",
            "imageable_id" => 2,
            "imageable_type" => "App\Models\Genus",]);
        Picture::firstOrCreate([
            "path" => "https://kids.nationalgeographic.com/content/dam/kids/photos/animals/Mammals/H-P/lion-male-roar.ngsversion.1466679939988.adapt.1900.1.jpg",
            "imageable_id" => 3,
            "imageable_type" => "App\Models\Species",]);
        Picture::firstOrCreate([
            "path" => "http://stichtingspots.nl/wp-content/uploads/2017/05/Katachtigen-algemeen-mei-2017.jpg",
            "imageable_id" => 2,
            "imageable_type" => "App\Models\Genus",]);
        Picture::firstOrCreate([
            "path" => "https://upload.wikimedia.org/wikipedia/commons/0/06/ChausCaudatusWolfSmit.jpg",
            "imageable_id" => 2,
            "imageable_type" => "App\Models\Genus"]);
        Picture::firstOrCreate([
            "path" => "https://upload.wikimedia.org/wikipedia/commons/d/da/Zoo_Wuppertal_Schwarzfusskatze.jpg",
            "imageable_id" => 2,
            "imageable_type" => "App\Models\Genus"]);
        Picture::firstOrCreate([
            "path" => "https://upload.wikimedia.org/wikipedia/commons/4/42/Homo_lineage_2017update.svg",
            "imageable_id" => 3,
            "imageable_type" => "App\Models\Genus"]);
        Picture::firstOrCreate([
            "path" => "http://l7.alamy.com/zooms/7376922b080f4fa2ac82f5dcc7016d0e/panthera-uncia-f3y3rr.jpg",
            "imageable_id" => 2,
            "imageable_type" => "App\Models\Genus"]);
        Picture::firstOrCreate([
            "path" => "https://upload.wikimedia.org/wikipedia/commons/5/56/General_Grant_Tree_in_Kings_Canyon_National_Park.jpg",
            "imageable_id" => 6,
            "imageable_type" => "App\Models\Genus"]);
        Picture::firstOrCreate([
            "path" => "http://www.geochembio.com/IMG/crocodilian-phylogeny.jpg",
            "imageable_id" => 1,
            "imageable_type" => "App\Models\Genus"]);
        Picture::firstOrCreate([
            "path" => "https://i.pinimg.com/originals/52/d8/a3/52d8a360c0b74148fd6e9f91d534d9b1.jpg",
            "imageable_id" => 1,
            "imageable_type" => "App\Models\Genus"]);
        Picture::firstOrCreate([
            "path" => "https://i.redd.it/6mb3c3okbmyx.png",
            "imageable_id" => 1,
            "imageable_type" => "App\Models\Genus"]);
        Picture::firstOrCreate([
            "path" => "http://www.telegraph.co.uk/content/dam/Travel/leadAssets/22/36/advice-nice_2236594a-xlarge.jpg",
            "imageable_id" => 2,
            "imageable_type" => "App\Models\Genus"]);
        Picture::firstOrCreate([
            "path" => "http://l7.alamy.com/zooms/7376922b080f4fa2ac82f5dcc7016d0e/panthera-uncia-f3y3rr.jpg",
            "imageable_id" => 2,
            "imageable_type" => "App\Models\Species"]);
        Picture::firstOrCreate([
            "path" => "http://animals.sandiegozoo.org/sites/default/files/2016-08/hero_zebra_animals.jpg",
            "imageable_id" => 6,
            "imageable_type" => "App\Models\Species"]);
        Picture::firstOrCreate([
            "path" => "http://slideplayer.com/slide/7335707/24/images/33/Simplified+Family+Tree+of+Equus.jpg",
            "imageable_id" => 4,
            "imageable_type" => "App\Models\Genus"]);
        Picture::firstOrCreate([
            "path" => "http://lemur.duke.edu/wordpress/wp-content/uploads/2013/12/remus-cover.jpg",
            "imageable_id" => 8,
            "imageable_type" => "App\Models\Genus",]);
    }
}