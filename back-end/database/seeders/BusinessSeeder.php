<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $names = [
            'Tech Solutions Inc.',
            'FPT Company.',
            'DataTech Systems',
            'Nine Plus Solution',
            'Data House Company',
            'NAL Solutions',
            'Kozocom Co.',
            'WAOCON&SG Company',
            'Global IT Systems',
            'CyberNest Labs',
            'AppTech Innovations',
            'CyberGuard Enterprises',
            'WebMatrix Inc.',
            'PixelPioneers Ltd.',
            'Tomosia Company',
            'BAP Company',
            'Wakumo Vietnam',
            'Sun* Company',
            'HIKONI Co., Ltd.',
            'VOOC Technology',
            'OnTech Co., Ltd',
            'D-Soft JSC.',
            'NFQ Asia',
            'Everfit Vietnam',
            'EFE Technology',
            'Enable Startup Co., Ltd',
            'Digital Fortress',
            'Enlab Software',
            'CodeComplete Vietnam',
            'Glotech JSC',
            'SupremeTech',
            'SNT Solutions Co., Ltd',
            'mgm Technologies',
            'KMS Technology Vietnam.',
            'Nitro Tech Asia Inc',
            'Kiaisoft Co., Ltd',
            'Mor Asia',
            'Goline Global',
            'Dev Plus',
            'CO-WELL Asia',
            'Asian Tech Co., Ltd',
            'FASTCODING VN',
            'Tran Inc.',
            'SmartDev',
            'FindX Company',
            'GEAR INC.',
            'Paracel Technology Solutions',
            'VJ TECHNOLOGIES',
            'TMA Solutions',
            'DTALENTS Company',
            'IR Tech Career',
        ];
        $avatars = [
            'https://www.techsolutionsinc.com/wp-content/uploads/2020/05/logo-tech-solutions-r1.png',
            'https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/FPT_logo_2010.svg/1200px-FPT_logo_2010.svg.png',
            'https://media.licdn.com/dms/image/D4E0BAQErXfou2EABIQ/company-logo_200_200/0/1664875249356?e=2147483647&v=beta&t=CSiTC7qBYTPBLp3zce9LmOMVm6VjXUt_vnLz8KNqekE',
            'https://nineplus.com.vn/wp-content/uploads/2022/06/cropped-logo-transparent-002.png',
            'https://static.topcv.vn/company_logos/mDEKcoUEwYbTZ9iLvXUbswh46MysHVq6_1659596768____457adcf5d444abea27906752903bb5ca.jpg',
            'https://static.topcv.vn/company_logos/681YDck0Wzya41FAsK8EZ5gm1UO4tN0d_1635306873____a67075d1e24126fe558a921a9453db7b.png',
            'https://jobsgo.vn/media/img/employer/49109-200x200.jpg?v=1596768801',
            'https://waocon-sg.vn/wp-content/uploads/2023/04/main-bgr-2.svg',
            'https://media.licdn.com/dms/image/C4E0BAQG0FFuAfUR8Hg/company-logo_200_200/0/1519909093503?e=2147483647&v=beta&t=Jou41Ow24dkbg6ph6fMxo_csZerDdhM88SycrDVfa5Q',
            'https://cyberneticlabs.io/_nuxt/img/logo.fc8541f.png',
            'https://www.apptech.global/wp-content/uploads/2020/07/logo-instagram.png',
            'https://media.licdn.com/dms/image/C560BAQEJyM-TV5cIzw/company-logo_200_200/0/1519861667486?e=2147483647&v=beta&t=ZG11_uPOFMhOwr5GImIDmEhqT8YuIrh3z0mkV11b55Q',
            'https://media.licdn.com/dms/image/C4E0BAQEeTcXsl8jGRg/company-logo_200_200/0/1632240176898?e=2147483647&v=beta&t=hicAsFC9Zjbzz1AaFkR8eT43RckQWvPisEthcH9l8Jg',
            'https://yt3.googleusercontent.com/ytc/AOPolaRNdQqBE_DS9NQOs16Kp47-NSd6NNnV6lYdzAqu=s900-c-k-c0x00ffffff-no-rj',
            'https://blog.tomosia.com/static/logo-384dd264b316048e1554ddbf9f6f7eba.png',
            'https://images.glints.com/unsafe/glints-dashboard.s3.amazonaws.com/company-logo/54a73a31e047e5c6e7a6fa4d798af43f.jpg',
            'https://media.licdn.com/dms/image/C5616AQEfIzoaTBETSg/profile-displaybackgroundimage-shrink_200_800/0/1668763237692?e=2147483647&v=beta&t=8pQR7v0IwUbbZbvuN9oVfxKVO6BBcz-telfHtS5ILOM',
            'https://sun-asterisk.vn/wp-content/uploads/2020/10/logo-sun@2x.png',
            'https://hikoni.com/assets/images/logo.png',
            'https://vooc.vn/wp-content/uploads/2020/04/cropped-logo-3-1.png',
            'https://cdn.dribbble.com/users/6028775/screenshots/17092156/media/a535fd8eb6565ffe8470fea5a7aa130c.png',
            'https://media.licdn.com/dms/image/C510BAQHFpNn1HSvhYw/company-logo_200_200/0/1564116396328?e=2147483647&v=beta&t=ikO7COHj-GdcVYfXUGpAlrKTMXYctKK6ov59RTohkw4',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTRjjlDvUCrIh10Bjm5FyMq0GaM4v9riT2U3wriY9gVcm3b0sw4jq5U9dySnkTuQtepJo&usqp=CAU',
            'https://s3-eu-west-1.amazonaws.com/tpd/logos/5f8797d00fb23d000105e68b/0x0.png',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbUyHo2iCczwQzDVYmfMl_VsMPUsiWbxVz26gJDArQD7fYcLlm3koTaIZHhZRE3k1MolU&usqp=CAU',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR0sau9Xa6_kDkpiTwYKjqgGC2k6BuW5Rh_bVdpwGOECjtepIr1yydfUY4fL04WEUHVzyQ&usqp=CAU',
            'https://icons.veryicon.com/png/o/miscellaneous/two-color-icon-library/user-286.png',
            'https://media.enlabsoftware.com/wp-content/uploads/2022/09/04183219/Top-offshore-software-development-in-Vietnam.jpg',
            'https://codecomplete.jp/wp-content/uploads/2023/03/logo-codecomplete-web-seo.jpg',
            'https://icons.veryicon.com/png/o/miscellaneous/two-color-icon-library/user-286.png',
            'https://icons.veryicon.com/png/o/miscellaneous/two-color-icon-library/user-286.png',
            'https://icons.veryicon.com/png/o/miscellaneous/two-color-icon-library/user-286.png',
            'https://icons.veryicon.com/png/o/miscellaneous/two-color-icon-library/user-286.png',
            'https://static.ybox.vn/2022/1/5/1642764943779-Thi%E1%BA%BFt%20k%E1%BA%BF%20kh%C3%B4ng%20t%C3%AAn%20(9).png',
            'https://haymora.com/upload/images/cong_nghe_thong_tin/thang_3_-_2019/nitrotech_asia/nitro-techasia-logo.png',
            'https://icons.veryicon.com/png/o/miscellaneous/two-color-icon-library/user-286.png',
            'https://morasia.co.jp/img/morasia-img.png',
            'https://i.ytimg.com/vi/RIxAPHA0Cfk/maxresdefault.jpg',
            'https://d3ml3b6vywsj0z.cloudfront.net/company_images/605db31810fce904a723341f_images.png',
            'https://co-well.vn/wp-content/uploads/2019/08/co-well-asia-logo.jpg',
            'https://media.licdn.com/dms/image/C560BAQG12POZVlalXA/company-logo_200_200/0/1519863874697?e=2147483647&v=beta&t=717Qmsyfrjx8CoUQqDfUQpjZ7Lb5EviSubYWoNULOAs',
            'https://static.topcv.vn/company_logos/v11CRFkpF5Ry052tUpxVMGjcZjsjJEGb_1678856383____a597bb64565a8fe9374461cdfcb4c820.jpg',
            'https://icons.veryicon.com/png/o/miscellaneous/two-color-icon-library/user-286.png',
            'https://smartdev.vn/wp-content/uploads/2021/03/apple-icon-180x180-1.png',
            'https://media.licdn.com/dms/image/D560BAQF7qWDahx9X0A/company-logo_200_200/0/1665548796486?e=2147483647&v=beta&t=p46bI_A_sIz59sZZ0wRRZk1sWoA2p575aChCCtFteJ0',
            'https://static.ybox.vn/2020/10/4/1602147720962-Cover%20(58).png',
            'https://paraceltech.com/wp-content/uploads/2023/03/logo.png',
            'https://s3-us-west-2.amazonaws.com/cbi-image-service-prd/original/d4715815-b463-43b2-815c-827bd998036e',
            'https://upload.wikimedia.org/wikipedia/commons/f/f9/TMA-Solutions-Logo.png',
            'https://static.topcv.vn/company_logos/PlEoP4VetBwaKTd1jfbC9eV4t1jWfa0F_1634810835____1ef91b9ee6fc8d4c59827e8876fd14b4.png',
            'https://irtech.com.vn/wp-content/themes/irtechwebsite/images/LogoIrtech.png'

        ];
        $emails = [];
        for ($i = 1; $i <= 51; $i++) {
            $emails[] = 'business' . $i;
        }
        $locations = ['Đà Nẵng', 'Hà Nội', 'TP Hồ Chí Minh', 'Quy Nhơn', 'Huế'];

        for ($i = 0; $i < count($names); $i++) {
            $name = $names[$i];
            $email = $emails[$i] . '@gmail.com';
            $password = $emails[$i] . '123';
            $phone = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
            $location = array_rand(array_flip($locations));
            $website = 'http://' . $name;
            $avatar = $avatars[$i];
            $career = 20;
            $size = 35;
            $status = true;

            DB::table('businesses')->insert([
                'id' => $i + 1,
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'phone' => $phone,
                'location' => $location,
                'website' => $website,
                'avatar' => $avatar,
                'career' => $career,
                'size' => $size,
                'status' => $status,
            ]);
        }
    }
}
