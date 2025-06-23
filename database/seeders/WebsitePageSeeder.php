<?php

namespace Database\Seeders;

use App\Models\FrontWebsitePage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsitePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $websitePage = [
            [
                'key' => 'aboutus',
                'value' => "{\"heading\":\"Shekinah Haitian SDA Church\",\"para_first\":\"Welcome to Shekinah Haitian SDA Church, the first Haitian Seventh-Day Adventist church in Fort Worth, Texas. We are a warm and loving congregation dedicated to spreading the message of God's love through vibrant worship, inspiring preaching, uplifting music, engaging kid programs, dynamic youth activities, and delicious Haitian food. We invite you to join us on this incredible journey of faith and discovery.\",\"para_second\":\"Our dedicated team is the heart and soul serving God and our community with integrity, compassion, and excellence under the direction of our pastor and with the help of passionate leaders and volunteers. With diverse gifts and talents, we work collaboratively to create an atmosphere that encourages spiritual growth, discipleship, and a deepening relationship with Jesus Christ.\",\"goal_heading\":\"Purpose and Goals\",\"goal_text\":\"Our goals include fostering spiritual growth, nurturing strong family foundations, equipping the next generation, and promoting unity and community service.\",\"goal_heading_second\":\"Introduction to the Team\",\"goal_text_second\":\"With diverse gifts and talents, we work collaboratively to create an atmosphere that encourages spiritual growth, discipleship, and a deepening relationship with Jesus Christ.\",\"goal_heading_third\":\"Achievements\",\"goal_text_third\":\"Shekinah Haitian SDA Church has achieved several significant milestones, including community outreach programs, youth mentorship, and establishing the first Haitian Seventh-Day Adventist congregation in Fort Worth.\"}",
            ],
        ];

        foreach ($websitePage as $page) {
            FrontWebsitePage::create($page);
        }
    }
}
