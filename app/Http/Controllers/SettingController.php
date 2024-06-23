<?php

namespace App\Http\Controllers;

use App\Helper;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function homePage(Request $request)
    {
        if ($request->isMethod('GET')) {
            $data = Helper::getHomePageSetting();
            return view('admin.setting.home', compact('data'));
        } else {

            if ($request->hasFile('logo')) {
                $imagePath = $request->file('logo')->storeAs('public/images', $request->file('logo')->getClientOriginalName());
                Helper::setSetting('header_logo', $imagePath);
            }
            if ($request->hasFile('favicon')) {
                $imagePath = $request->file('favicon')->storeAs('public/images', $request->file('favicon')->getClientOriginalName());
                Helper::setSetting('web_favicon', $imagePath);
            }

            $web_title = $request->webtitle ?? '';
            $header_phone = $request->h_phone ?? '';
            $meta_description= $request->metadesc ?? '';

            $quickLinks = [];
            if ($request->has('quick_link_title')) {
                foreach ($request->quick_link_title as $index => $title) {
                    if (!empty($title)) {
                        $quickLinks[] = [
                            'title' => $title,
                            'url' => $request->quick_link_url[$index] ?? '',
                        ];
                    }
                }
            }
        Helper::setSetting('home_quick_links', json_encode($quickLinks));

            $faq_heading= $request->faqheading ?? '';
            $faq_desc= $request->faqdesc ?? '';


            $news_letter_heading= $request->newsletterheading ?? '';
            $video_url= $request->videourl ?? '';

            $gallery_heading1= $request->galleryheading1 ?? '';
            $gallery_heading2= $request->galleryheading2 ?? '';



            Helper::setSetting('web_title', $web_title);
            Helper::setSetting('header_phone', $header_phone);
            Helper::setSetting('meta_description', $meta_description);


            Helper::setSetting('faq_heading', $faq_heading);
            Helper::setSetting('faq_desc', $faq_desc);

            Helper::setSetting('news_letter_heading', $news_letter_heading);
            Helper::setSetting('video_url', $video_url);
            Helper::setSetting('gallery_heading1', $gallery_heading1);
            Helper::setSetting('gallery_heading2', $gallery_heading2);


            $data = Helper::getHomePageSetting();

            return redirect()->back()->with('success', 'Page Updated successfully.');

        }
    }

    public function aboutPage(Request $request)
{
    if ($request->isMethod('GET')) {
        $data = Helper::getAboutPageSettings(); // Use getAboutPageSettings instead of getHomePageSetting
        return view('admin.setting.about', compact('data'));
    } else {
        // Handle form submission (POST request)

        // Handle file uploads (logo and favicon)
        if ($request->hasFile('bgimage')) {
            $bgImagePath = $request->file('bgimage')->store('public/images'); // Adjust as per your storage configuration
            Helper::setSetting('about_bg_image', $bgImagePath);
        }

        if ($request->hasFile('aboutimage1')) {
            $aboutImage1Path = $request->file('aboutimage1')->store('public/images');
            Helper::setSetting('about_image1', $aboutImage1Path);
        }

        if ($request->hasFile('aboutimage2')) {
            $aboutImage2Path = $request->file('aboutimage2')->store('public/images');
            Helper::setSetting('about_image2', $aboutImage2Path);
        }

        $heading1 = $request->input('heading1', '');
        $desc1 = $request->input('desc1', '');
        $heading2 = $request->input('heading2', '');
        $desc2 = $request->input('desc2', '');

        Helper::setSetting('about_heading1', $heading1);
        Helper::setSetting('about_desc1', $desc1);
        Helper::setSetting('about_heading2', $heading2);
        Helper::setSetting('about_desc2', $desc2);

        return redirect()->back()->with('success', 'About Page settings updated successfully.');
    }
}
public function servicePage(Request $request)
{
    if ($request->isMethod('GET')) {
        $data = Helper::getServicePageSetting(); // Use getAboutPageSettings instead of getHomePageSetting
        return view('admin.setting.service', compact('data'));
    } else {

        if ($request->hasFile('bgimage')) {
            $bgImagePath = $request->file('bgimage')->store('public/images'); // Adjust as per your storage configuration
            Helper::setSetting('service_bg_image', $bgImagePath);
        }



        $service_heading1 = $request->input('heading1', '');
        $service_heading2 = $request->input('heading2', '');

        Helper::setSetting('service_heading1', $service_heading1);
        Helper::setSetting('service_heading2', $service_heading2);

        return redirect()->back()->with('success', 'Service Page settings updated successfully.');
    }
}

public function blogPage(Request $request)
{
    if ($request->isMethod('GET')) {
        $data = Helper::getBlogPageSetting(); // Use getAboutPageSettings instead of getHomePageSetting
        return view('admin.setting.blog', compact('data'));
    } else {

        if ($request->hasFile('bgimage')) {
            $bgImagePath = $request->file('bgimage')->store('public/images'); // Adjust as per your storage configuration
            Helper::setSetting('blog_bg_image', $bgImagePath);
        }


        return redirect()->back()->with('success', 'Blog Page settings updated successfully.');
    }
}
    public function contactPage(Request $request)
    {
        if ($request->isMethod('GET')) {
            $data = Helper::getContactPageSetting();
            return view('admin.setting.contact', compact('data'));
        } else {

            if ($request->hasFile('bgimage')) {
                $bgImagePath = $request->file('bgimage')->store('public/images');
                Helper::setSetting('contact_bg_image', $bgImagePath);
            }
            $contact_heading = $request->heading ?? '';
            $contact_phone = $request->phone ?? '';
            $contact_email = $request->email ?? '';
            $contact_address = $request->address?? '';
            $contact_location = $request->location ?? '';


            Helper::setSetting('contact_heading', $contact_heading);
            Helper::setSetting('contact_phone', $contact_phone);
            Helper::setSetting('contact_email', $contact_email);
            Helper::setSetting('contact_address', $contact_address);
            Helper::setSetting('contact_location', $contact_location);


            $data = Helper::getContactPageSetting();

            return redirect()->back()->with('success', 'Page Updated successfully.');

        }
    }

    public function otherPage(Request $request)
{
    if ($request->isMethod('GET')) {
        $data = Helper::getOtherPageSetting();
        return view('admin.setting.page', compact('data'));
    } else {
        if ($request->hasFile('g_image')) {
            $imagePath = $request->file('g_image')->storeAs('public/images', $request->file('g_image')->getClientOriginalName());
            Helper::setSetting('other_g_image', $imagePath);
        }
        if ($request->hasFile('b_image')) {
            $imagePath = $request->file('b_image')->storeAs('public/images', $request->file('b_image')->getClientOriginalName());
            Helper::setSetting('other_b_image', $imagePath);
        }
        if ($request->hasFile('f_image')) {
            $imagePath = $request->file('f_image')->storeAs('public/images', $request->file('f_image')->getClientOriginalName());
            Helper::setSetting('other_f_image', $imagePath);
        }
        if ($request->hasFile('mgmt_image')) {
            $imagePath = $request->file('mgmt_image')->storeAs('public/images', $request->file('mgmt_image')->getClientOriginalName());
            Helper::setSetting('other_mgmt_image', $imagePath);
        }
        if ($request->hasFile('m_image')) {
            $imagePath = $request->file('m_image')->storeAs('public/images', $request->file('m_image')->getClientOriginalName());
            Helper::setSetting('other_m_image', $imagePath);
        }


        return redirect()->back()->with('success', 'Page settings updated successfully.');
    }
}



    public function footerPage(Request $request)
    {
        if ($request->isMethod('GET')) {
            $data = Helper::getFooterSetting();
            return view('admin.setting.footer', compact('data'));
        } else {
            if ($request->hasFile('logo')) {
                $imagePath = $request->file('logo')->storeAs('public/images', $request->file('logo')->getClientOriginalName());
                Helper::setSetting('footer_logo', $imagePath);
            }
            $description = $request->description ?? '';
            $phone = $request->phone ?? '';
            $email = $request->email ?? '';
            $address = $request->address ?? '';
            $footer_copyright = $request->copyright ?? '';


            Helper::setSetting('footer_desc', $description);


            $socialLinks = [];
        if ($request->has('social_media')) {
            foreach ($request->social_media as $index => $socialMedia) {
                if (!empty($socialMedia)) {
                    $socialLinks[] = [
                        'name' => $socialMedia,
                        'link' => $request->social_link[$index] ?? '',
                    ];
                }
            }
        }
        Helper::setSetting('footer_social_links', json_encode($socialLinks));

        $quickLinks = [];
        if ($request->has('quick_link_title')) {
            foreach ($request->quick_link_title as $index => $title) {
                if (!empty($title)) {
                    $quickLinks[] = [
                        'title' => $title,
                        'url' => $request->quick_link_url[$index] ?? '',
                    ];
                }
            }
        }
        Helper::setSetting('footer_quick_links', json_encode($quickLinks));

            Helper::setSetting('footer_phone', $phone);
            Helper::setSetting('footer_email', $email);
            Helper::setSetting('footer_address', $address);
            Helper::setSetting('footer_copyright', $footer_copyright);


            $data = Helper::getFooterSetting();

            return redirect()->back()->with('success', 'Page Updated successfully.');
        }
    }
}
