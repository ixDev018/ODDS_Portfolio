<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OddsAboutSection;

class AboutSectionSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate existing about sections so updates take effect cleanly
        OddsAboutSection::truncate();

        OddsAboutSection::create([
            'title' => 'The Bet We Made',
            'slug' => 'the-bet-we-made',
            'subtitle' => 'How we ended up building the parts of your business nobody applauds — and the parts everyone judges you by — under one roof.',
            'category' => 'PHILOSOPHY',
            'author' => 'ODDS Core Team',
            'read_time' => '4 min read',
            'sort_order' => 1,
            'is_active' => true,
            'body_content' => [
                ['type' => 'heading2', 'content' => "Nobody Asks For What They're Actually Missing"],
                ['type' => 'paragraph', 'content' => "Most people come to a studio knowing what they want. A site. An app. A logo. What they usually don't know is what's actually broken — the thing quietly costing them money, trust, or time, that nobody's bothered to name yet. We got good at finding that thing. Not because we're consultants. Because we've built enough of everything to recognize a gap on sight."],
                ['type' => 'paragraph', 'content' => "We don't wait for a brief. We look for the hole first, then decide what fills it."],
                ['type' => 'heading2', 'content' => 'We Refused to Pick a Lane'],
                ['type' => 'paragraph', 'content' => 'Somewhere along the way, "development studio" and "the people who make you look good" became two different businesses, staffed by two different teams, billed on two different invoices. We never understood why. So we didn\'t split ourselves in half. Same people who ship the thing running underneath your business are the ones deciding how it should feel the moment someone sees it.'],
                ['type' => 'paragraph', 'content' => 'One team. One standard. Nothing gets handed off half-finished.']
            ]
        ]);

        OddsAboutSection::create([
            'title' => 'We Never Picked a Specialty',
            'slug' => 'we-never-picked-a-specialty',
            'subtitle' => 'Because the problem never announces what kind of solution it needs — so neither do we.',
            'category' => 'RANGE',
            'author' => 'ODDS Architecture',
            'read_time' => '3 min read',
            'sort_order' => 2,
            'is_active' => true,
            'body_content' => [
                ['type' => 'heading2', 'content' => 'The Job Was Never "One Thing"'],
                ['type' => 'paragraph', 'content' => "Ask us what we do and you'll get a different answer depending on the week. That's not a lack of focus. It's the opposite. We built the habit of showing up as whatever the problem actually required, instead of forcing every problem through the one skill we happened to be comfortable with. Some weeks that looks like a system running quietly behind a business. Other weeks it looks like the first thing a customer ever sees of you."],
                ['type' => 'paragraph', 'content' => 'We don\'t ask "is this our thing?" We ask "does it need building?" Then we build it.'],
                ['type' => 'heading2', 'content' => "Range Isn't the Same as Scattered"],
                ['type' => 'paragraph', 'content' => 'Studios that do "a bit of everything" usually do all of it half-heartedly. That\'s not what this is. Every direction we go, we go all the way — because the standard doesn\'t change depending on what we\'re building, only the shape of the work does. The thing running in the background gets the same attention as the thing on the front page. Neither one is the "real" work and the other the afterthought.'],
                ['type' => 'paragraph', 'content' => 'Nothing here is a side project. Everything ships like it\'s the main thing.']
            ]
        ]);

        OddsAboutSection::create([
            'title' => 'We Didn\'t Start Here',
            'slug' => 'we-didnt-start-here',
            'subtitle' => 'Long before ODDS shipped a system, it was pointing a camera at something and figuring out how to make people feel it.',
            'category' => 'ORIGIN',
            'author' => 'ODDS Core Team',
            'read_time' => '4 min read',
            'sort_order' => 3,
            'is_active' => true,
            'body_content' => [
                ['type' => 'heading2', 'content' => 'Nobody Taught Us to Stay in One Room'],
                ['type' => 'paragraph', 'content' => "We didn't come up through a computer science program that told us where the lane markers were. We came up building things that had to work and had to move people — and nobody ever separated those into two departments. So when the tools changed, we changed with them. The instinct stayed the same: figure out what makes something land, then go build it, whatever it turns out to be made of."],
                ['type' => 'paragraph', 'content' => "We were never hired to write code. We were hired to make something people couldn't look away from — code just became one of the ways we did that."],
                ['type' => 'heading2', 'content' => 'The Habit Never Left'],
                ['type' => 'paragraph', 'content' => "That's the part that didn't change when the studio did. The same eye that used to frame a shot is the one deciding how a dashboard should feel to open. The same instinct that used to cut a trailer for tension is the one that decides where a user's attention should land first. We didn't inherit a technical philosophy and bolt storytelling onto it later. It was always one skill, wearing different outfits depending on the year."],
                ['type' => 'paragraph', 'content' => 'Everything we build still has to do the one thing we never stopped chasing: make someone feel something on purpose.']
            ]
        ]);
    }
}
