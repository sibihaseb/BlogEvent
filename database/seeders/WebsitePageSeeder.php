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
            [
                'key' => 'contactus',
                'value' => "{\"address_heading\":\"Address\",\"address_text\":\"205 E Carver St Alvarado, Texas 76009\",\"website_heading\":\"Website\",\"website_text\":\"Shekinah Haitian Seventh-Day Adventist Church\",\"email_heading\":\"Email\",\"email_text\":\"info@shekinahsda.org \",\"map_url\":\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3368.619162376989!2d-97.21068012387472!3d32.402569103027055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864e5b96faea41df%3A0xb63ef95cc5029c8c!2s205%20E%20Carver%20St%2C%20Alvarado%2C%20TX%2076009%2C%20USA!5e0!3m2!1sen!2s!4v1748550604995!5m2!1sen!2s\"}"
            ],
            [
                'key' => 'homepage',
                'value' => "{\"hero_title\":\"Welcome to Shekinah\",\"hero_subtitle\":\"Where Faith Meets Community\",\"hero_description\":\"Join us as we worship, grow, and serve together in Christ. Experience the warmth of our community and the power of God's presence every Sabbath.\",\"stay_heading\":\"Stay Connected\",\"stay_description\":\"Subscribe to our newsletter for updates and announcements.\",\"church_title\":\"Welcome to Our Haitian Church Family\",\"church_description\":\"We proudly serve the Haitian community in Miami, preserving our cultural heritage while worshipping God. Join us every Saturday for an inspiring worship experience in both Haitian Creole and English.\",\"side_img\":\"\",\"service_times\":\"Sabbath Service Times:\",\"school_time\":\"9:30 AM - Sabbath School\",\"devine_time\":\"11:00 AM - Divine Service\",\"flag_icon\":\"\",\"info_cards\":[{\"title\":\"Service Times\",\"description\":\"Sabbath School: 9:30 AM<br/>Divine Service: 11:00 AM<br/>Prayer Meeting: Wed 7:00 PM\",\"button_text\":\"View Schedule\",\"button_url\":\"#services\"},{\"title\":\"Watch Online\",\"description\":\"Join our services live or watch past sermons.\",\"button_text\":\"View Livestream\",\"button_url\":\"#livestream\"},{\"title\":\"Give Online\",\"description\":\"Support our mission and ministries securely online.\",\"button_text\":\"Donate Now\",\"button_url\":\"#donate\"},{\"title\":\"New Here?\",\"description\":\"We'd love to welcome you to our church family.\",\"button_text\":\"Learn More\",\"button_url\":\"/register\"}],\"recurring_event_title\":\"Weekly Events\",\"text_1\":\"Sabbath School: Every Saturday at 9:30 AM\",\"text_2\":\"Divine Service: Every Saturday at 11:00 AM\",\"text_3\":\"Prayer Meeting: Every Wednesday at 7:00 PM\",\"text_4\":\"Youth Group: Every Friday at 6:30 PM\",\"stay_connect_heading\":\"Connect With Us\",\"stay_connect_description\":\"Follow us on social media and stay updated with our community events and announcements.\",\"stay_connect_item_1\":\"Facebook: @ShekinahSDA\",\"stay_connect_item_2\":\"Instagram: @ShekinahHaitianSDA\",\"stay_connect_item_3\":\"Email: info@shekinahsda.org\",\"about_heading\":\"About Shekinah Haitian SDA Church\",\"about_para_first\":\"Shekinah Haitian Seventh-day Adventist Church was established in 2005 with a mission to serve the Haitian community and beyond. Our name \\\"Shekinah\\\" refers to the dwelling or settling of the divine presence of God, which is at the heart of everything we do.\",\"about_para_second\":\"We are a vibrant, multicultural congregation committed to sharing the love of Jesus Christ through worship, fellowship, discipleship, ministry, and evangelism. Our services are conducted in both Haitian Creole and English to serve our diverse community.\",\"mission_heading\":\"Our Mission\",\"mission_description\":\"To make disciples of Jesus Christ who love God, serve others, and transform communities.\",\"vision_heading\":\"Our Vision\",\"vision_description\":\"To be a beacon of hope, healing, and spiritual growth, reflecting God's love in our community and beyond.\",\"about_image_1\":\"\",\"about_image_2\":\"\",\"about_image_3\":\"\",\"about_image_4\":\"\"}"

            ]
        ];



        foreach ($websitePage as $page) {
            FrontWebsitePage::create($page);
        }
    }
}
