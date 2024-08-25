<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'name_en' => 'Unknown',
                'name_ar' => 'غير معروف',
                'nationality_en' => 'Unknown',
                'nationality_ar' => 'غير معروف',
                'code' => 'Unknown',
            ],
            [
                "code" => "AF",
                "name_en" => " Afghanistan",
                "name_ar" => "أفغانستان",
                "nationality_en" => "Afghan",
                "nationality_ar" => "أفغانستاني"
            ],
            [
                "code" => "AL",
                "name_en" => " Albania",
                "name_ar" => "ألبانيا",
                "nationality_en" => "Albanian",
                "nationality_ar" => "ألباني"
            ],
            [
                "code" => "AX",
                "name_en" => " Aland Islands",
                "name_ar" => "جزر آلاند",
                "nationality_en" => "Aland Islander",
                "nationality_ar" => "آلاندي"
            ],
            [
                "code" => "DZ",
                "name_en" => " Algeria",
                "name_ar" => "الجزائر",
                "nationality_en" => "Algerian",
                "nationality_ar" => "جزائري"
            ],
            [
                "code" => "AS",
                "name_en" => " American Samoa",
                "name_ar" => "ساموا-الأمريكي",
                "nationality_en" => "American Samoan",
                "nationality_ar" => "أمريكي سامواني"
            ],
            [
                "code" => "AD",
                "name_en" => " Andorra",
                "name_ar" => "أندورا",
                "nationality_en" => "Andorran",
                "nationality_ar" => "أندوري"
            ],
            [
                "code" => "AO",
                "name_en" => " Angola",
                "name_ar" => "أنغولا",
                "nationality_en" => "Angolan",
                "nationality_ar" => "أنقولي"
            ],
            [
                "code" => "AI",
                "name_en" => " Anguilla",
                "name_ar" => "أنغويلا",
                "nationality_en" => "Anguillan",
                "nationality_ar" => "أنغويلي"
            ],
            [
                "code" => "AQ",
                "name_en" => " Antarctica",
                "name_ar" => "أنتاركتيكا",
                "nationality_en" => "Antarctican",
                "nationality_ar" => "أنتاركتيكي"
            ],
            [
                "code" => "AG",
                "name_en" => " Antigua and Barbuda",
                "name_ar" => "أنتيغوا وبربودا",
                "nationality_en" => "Antiguan",
                "nationality_ar" => "بربودي"
            ],
            [
                "code" => "AR",
                "name_en" => " Argentina",
                "name_ar" => "الأرجنتين",
                "nationality_en" => "Argentinian",
                "nationality_ar" => "أرجنتيني"
            ],
            [
                "code" => "AM",
                "name_en" => " Armenia",
                "name_ar" => "أرمينيا",
                "nationality_en" => "Armenian",
                "nationality_ar" => "أرميني"
            ],
            [
                "code" => "AW",
                "name_en" => " Aruba",
                "name_ar" => "أروبه",
                "nationality_en" => "Aruban",
                "nationality_ar" => "أوروبهيني"
            ],
            [
                "code" => "AU",
                "name_en" => " Australia",
                "name_ar" => "أستراليا",
                "nationality_en" => "Australian",
                "nationality_ar" => "أسترالي"
            ],
            [
                "code" => "AT",
                "name_en" => " Austria",
                "name_ar" => "النمسا",
                "nationality_en" => "Austrian",
                "nationality_ar" => "نمساوي"
            ],
            [
                "code" => "AZ",
                "name_en" => " Azerbaijan",
                "name_ar" => "أذربيجان",
                "nationality_en" => "Azerbaijani",
                "nationality_ar" => "أذربيجاني"
            ],
            [
                "code" => "BS",
                "name_en" => " Bahamas",
                "name_ar" => "الباهاماس",
                "nationality_en" => "Bahamian",
                "nationality_ar" => "باهاميسي"
            ],
            [
                "code" => "BH",
                "name_en" => " Bahrain",
                "name_ar" => "البحرين",
                "nationality_en" => "Bahraini",
                "nationality_ar" => "بحريني"
            ],
            [
                "code" => "BD",
                "name_en" => " Bangladesh",
                "name_ar" => "بنغلاديش",
                "nationality_en" => "Bangladeshi",
                "nationality_ar" => "بنغلاديشي"
            ],
            [
                "code" => "BB",
                "name_en" => " Barbados",
                "name_ar" => "بربادوس",
                "nationality_en" => "Barbadian",
                "nationality_ar" => "بربادوسي"
            ],
            [
                "code" => "BY",
                "name_en" => " Belarus",
                "name_ar" => "روسيا البيضاء",
                "nationality_en" => "Belarusian",
                "nationality_ar" => "روسي"
            ],
            [
                "code" => "BE",
                "name_en" => " Belgium",
                "name_ar" => "بلجيكا",
                "nationality_en" => "Belgian",
                "nationality_ar" => "بلجيكي"
            ],
            [
                "code" => "BZ",
                "name_en" => " Belize",
                "name_ar" => "بيليز",
                "nationality_en" => "Belizean",
                "nationality_ar" => "بيليزي"
            ],
            [
                "code" => "BJ",
                "name_en" => " Benin",
                "name_ar" => "بنين",
                "nationality_en" => "Beninese",
                "nationality_ar" => "بنيني"
            ],
            [
                "code" => "BL",
                "name_en" => " Saint Barthelemy",
                "name_ar" => "سان بارتيلمي",
                "nationality_en" => "Saint Barthelmian",
                "nationality_ar" => "سان بارتيلمي"
            ],
            [
                "code" => "BM",
                "name_en" => " Bermuda",
                "name_ar" => "جزر برمودا",
                "nationality_en" => "Bermudan",
                "nationality_ar" => "برمودي"
            ],
            [
                "code" => "BT",
                "name_en" => " Bhutan",
                "name_ar" => "بوتان",
                "nationality_en" => "Bhutanese",
                "nationality_ar" => "بوتاني"
            ],
            [
                "code" => "BO",
                "name_en" => " Bolivia",
                "name_ar" => "بوليفيا",
                "nationality_en" => "Bolivian",
                "nationality_ar" => "بوليفي"
            ],
            [
                "code" => "BA",
                "name_en" => " Bosnia and Herzegovina",
                "name_ar" => "البوسنة و الهرسك",
                "nationality_en" => "Bosnian / Herzegovinian",
                "nationality_ar" => "بوسني/هرسكي"
            ],
            [
                "code" => "BW",
                "name_en" => " Botswana",
                "name_ar" => "بوتسوانا",
                "nationality_en" => "Botswanan",
                "nationality_ar" => "بوتسواني"
            ],
            [
                "code" => "BV",
                "name_en" => " Bouvet Island",
                "name_ar" => "جزيرة بوفيه",
                "nationality_en" => "Bouvetian",
                "nationality_ar" => "بوفيهي"
            ],
            [
                "code" => "BR",
                "name_en" => " Brazil",
                "name_ar" => "البرازيل",
                "nationality_en" => "Brazilian",
                "nationality_ar" => "برازيلي"
            ],
            [
                "code" => "IO",
                "name_en" => " British Indian Ocean Territory",
                "name_ar" => "إقليم المحيط الهندي البريطاني",
                "nationality_en" => "British Indian Ocean Territory",
                "nationality_ar" => "إقليم المحيط الهندي البريطاني"
            ],
            [
                "code" => "BN",
                "name_en" => " Brunei Darussalam",
                "name_ar" => "بروني",
                "nationality_en" => "Bruneian",
                "nationality_ar" => "بروني"
            ],
            [
                "code" => "BG",
                "name_en" => " Bulgaria",
                "name_ar" => "بلغاريا",
                "nationality_en" => "Bulgarian",
                "nationality_ar" => "بلغاري"
            ],
            [
                "code" => "BF",
                "name_en" => " Burkina Faso",
                "name_ar" => "بوركينا فاسو",
                "nationality_en" => "Burkinabe",
                "nationality_ar" => "بوركيني"
            ],
            [
                "code" => "BI",
                "name_en" => " Burundi",
                "name_ar" => "بوروندي",
                "nationality_en" => "Burundian",
                "nationality_ar" => "بورونيدي"
            ],
            [
                "code" => "KH",
                "name_en" => " Cambodia",
                "name_ar" => "كمبوديا",
                "nationality_en" => "Cambodian",
                "nationality_ar" => "كمبودي"
            ],
            [
                "code" => "CM",
                "name_en" => " Cameroon",
                "name_ar" => "كاميرون",
                "nationality_en" => "Cameroonian",
                "nationality_ar" => "كاميروني"
            ],
            [
                "code" => "CA",
                "name_en" => " Canada",
                "name_ar" => "كندا",
                "nationality_en" => "Canadian",
                "nationality_ar" => "كندي"
            ],
            [
                "code" => "CV",
                "name_en" => " Cape Verde",
                "name_ar" => "الرأس الأخضر",
                "nationality_en" => "Cape Verdean",
                "nationality_ar" => "الرأس الأخضر"
            ],
            [
                "code" => "KY",
                "name_en" => " Cayman Islands",
                "name_ar" => "جزر كايمان",
                "nationality_en" => "Caymanian",
                "nationality_ar" => "كايماني"
            ],
            [
                "code" => "CF",
                "name_en" => " Central African Republic",
                "name_ar" => "جمهورية أفريقيا الوسطى",
                "nationality_en" => "Central African",
                "nationality_ar" => "أفريقي"
            ],
            [
                "code" => "TD",
                "name_en" => " Chad",
                "name_ar" => "تشاد",
                "nationality_en" => "Chadian",
                "nationality_ar" => "تشادي"
            ],
            [
                "code" => "CL",
                "name_en" => " Chile",
                "name_ar" => "شيلي",
                "nationality_en" => "Chilean",
                "nationality_ar" => "شيلي"
            ],
            [
                "code" => "CN",
                "name_en" => " China",
                "name_ar" => "الصين",
                "nationality_en" => "Chinese",
                "nationality_ar" => "صيني"
            ],
            [
                "code" => "CX",
                "name_en" => " Christmas Island",
                "name_ar" => "جزيرة عيد الميلاد",
                "nationality_en" => "Christmas Islander",
                "nationality_ar" => "جزيرة عيد الميلاد"
            ],
            [
                "code" => "CC",
                "name_en" => " Cocos (Keeling) Islands",
                "name_ar" => "جزر كوكوس",
                "nationality_en" => "Cocos Islander",
                "nationality_ar" => "جزر كوكوس"
            ],
            [
                "code" => "CO",
                "name_en" => " Colombia",
                "name_ar" => "كولومبيا",
                "nationality_en" => "Colombian",
                "nationality_ar" => "كولومبي"
            ],
            [
                "code" => "KM",
                "name_en" => " Comoros",
                "name_ar" => "جزر القمر",
                "nationality_en" => "Comorian",
                "nationality_ar" => "جزر القمر"
            ],
            [
                "code" => "CG",
                "name_en" => " Congo",
                "name_ar" => "الكونغو",
                "nationality_en" => "Congolese",
                "nationality_ar" => "كونغي"
            ],
            [
                "code" => "CK",
                "name_en" => " Cook Islands",
                "name_ar" => "جزر كوك",
                "nationality_en" => "Cook Islander",
                "nationality_ar" => "جزر كوك"
            ],
            [
                "code" => "CR",
                "name_en" => " Costa Rica",
                "name_ar" => "كوستاريكا",
                "nationality_en" => "Costa Rican",
                "nationality_ar" => "كوستاريكي"
            ],
            [
                "code" => "HR",
                "name_en" => " Croatia",
                "name_ar" => "كرواتيا",
                "nationality_en" => "Croatian",
                "nationality_ar" => "كوراتي"
            ],
            [
                "code" => "CU",
                "name_en" => " Cuba",
                "name_ar" => "كوبا",
                "nationality_en" => "Cuban",
                "nationality_ar" => "كوبي"
            ],
            [
                "code" => "CY",
                "name_en" => " Cyprus",
                "name_ar" => "قبرص",
                "nationality_en" => "Cypriot",
                "nationality_ar" => "قبرصي"
            ],
            [
                "code" => "CW",
                "name_en" => " Curaçao",
                "name_ar" => "كوراساو",
                "nationality_en" => "Curacian",
                "nationality_ar" => "كوراساوي"
            ],
            [
                "code" => "CZ",
                "name_en" => " Czech Republic",
                "name_ar" => "الجمهورية التشيكية",
                "nationality_en" => "Czech",
                "nationality_ar" => "تشيكي"
            ],
            [
                "code" => "DK",
                "name_en" => " Denmark",
                "name_ar" => "الدانمارك",
                "nationality_en" => "Danish",
                "nationality_ar" => "دنماركي"
            ],
            [
                "code" => "DJ",
                "name_en" => " Djibouti",
                "name_ar" => "جيبوتي",
                "nationality_en" => "Djiboutian",
                "nationality_ar" => "جيبوتي"
            ],
            [
                "code" => "DM",
                "name_en" => " Dominica",
                "name_ar" => "دومينيكا",
                "nationality_en" => "Dominican",
                "nationality_ar" => "دومينيكي"
            ],
            [
                "code" => "DO",
                "name_en" => " Dominican Republic",
                "name_ar" => "الجمهورية الدومينيكية",
                "nationality_en" => "Dominican",
                "nationality_ar" => "دومينيكي"
            ],
            [
                "code" => "EC",
                "name_en" => " Ecuador",
                "name_ar" => "إكوادور",
                "nationality_en" => "Ecuadorian",
                "nationality_ar" => "إكوادوري"
            ],
            [
                "code" => "EG",
                "name_en" => " Egypt",
                "name_ar" => "مصر",
                "nationality_en" => "Egyptian",
                "nationality_ar" => "مصري"
            ],
            [
                "code" => "SV",
                "name_en" => " El Salvador",
                "name_ar" => "إلسلفادور",
                "nationality_en" => "Salvadoran",
                "nationality_ar" => "سلفادوري"
            ],
            [
                "code" => "GQ",
                "name_en" => " Equatorial Guinea",
                "name_ar" => "غينيا الاستوائي",
                "nationality_en" => "Equatorial Guinean",
                "nationality_ar" => "غيني"
            ],
            [
                "code" => "ER",
                "name_en" => " Eritrea",
                "name_ar" => "إريتريا",
                "nationality_en" => "Eritrean",
                "nationality_ar" => "إريتيري"
            ],
            [
                "code" => "EE",
                "name_en" => " Estonia",
                "name_ar" => "استونيا",
                "nationality_en" => "Estonian",
                "nationality_ar" => "استوني"
            ],
            [
                "code" => "ET",
                "name_en" => " Ethiopia",
                "name_ar" => "أثيوبيا",
                "nationality_en" => "Ethiopian",
                "nationality_ar" => "أثيوبي"
            ],
            [
                "code" => "FK",
                "name_en" => " Falkland Islands (Malvinas)",
                "name_ar" => "جزر فوكلاند",
                "nationality_en" => "Falkland Islander",
                "nationality_ar" => "فوكلاندي"
            ],
            [
                "code" => "FO",
                "name_en" => " Faroe Islands",
                "name_ar" => "جزر فارو",
                "nationality_en" => "Faroese",
                "nationality_ar" => "جزر فارو"
            ],
            [
                "code" => "FJ",
                "name_en" => " Fiji",
                "name_ar" => "فيجي",
                "nationality_en" => "Fijian",
                "nationality_ar" => "فيجي"
            ],
            [
                "code" => "FI",
                "name_en" => " Finland",
                "name_ar" => "فنلندا",
                "nationality_en" => "Finnish",
                "nationality_ar" => "فنلندي"
            ],
            [
                "code" => "FR",
                "name_en" => " France",
                "name_ar" => "فرنسا",
                "nationality_en" => "French",
                "nationality_ar" => "فرنسي"
            ],
            [
                "code" => "GF",
                "name_en" => " French Guiana",
                "name_ar" => "غويانا الفرنسية",
                "nationality_en" => "French Guianese",
                "nationality_ar" => "غويانا الفرنسية"
            ],
            [
                "code" => "PF",
                "name_en" => " French Polynesia",
                "name_ar" => "بولينيزيا الفرنسية",
                "nationality_en" => "French Polynesian",
                "nationality_ar" => "بولينيزيي"
            ],
            [
                "code" => "TF",
                "name_en" => " French Southern and Antarctic Lands",
                "name_ar" => "أراض فرنسية جنوبية وأنتارتيكية",
                "nationality_en" => "French",
                "nationality_ar" => "أراض فرنسية جنوبية وأنتارتيكية"
            ],
            [
                "code" => "GA",
                "name_en" => " Gabon",
                "name_ar" => "الغابون",
                "nationality_en" => "Gabonese",
                "nationality_ar" => "غابوني"
            ],
            [
                "code" => "GM",
                "name_en" => " Gambia",
                "name_ar" => "غامبيا",
                "nationality_en" => "Gambian",
                "nationality_ar" => "غامبي"
            ],
            [
                "code" => "GE",
                "name_en" => " Georgia",
                "name_ar" => "جيورجيا",
                "nationality_en" => "Georgian",
                "nationality_ar" => "جيورجي"
            ],
            [
                "code" => "DE",
                "name_en" => " Germany",
                "name_ar" => "ألمانيا",
                "nationality_en" => "German",
                "nationality_ar" => "ألماني"
            ],
            [
                "code" => "GH",
                "name_en" => " Ghana",
                "name_ar" => "غانا",
                "nationality_en" => "Ghanaian",
                "nationality_ar" => "غاني"
            ],
            [
                "code" => "GI",
                "name_en" => " Gibraltar",
                "name_ar" => "جبل طارق",
                "nationality_en" => "Gibraltar",
                "nationality_ar" => "جبل طارق"
            ],
            [
                "code" => "GG",
                "name_en" => " Guernsey",
                "name_ar" => "غيرنزي",
                "nationality_en" => "Guernsian",
                "nationality_ar" => "غيرنزي"
            ],
            [
                "code" => "GR",
                "name_en" => " Greece",
                "name_ar" => "اليونان",
                "nationality_en" => "Greek",
                "nationality_ar" => "يوناني"
            ],
            [
                "code" => "GL",
                "name_en" => " Greenland",
                "name_ar" => "جرينلاند",
                "nationality_en" => "Greenlandic",
                "nationality_ar" => "جرينلاندي"
            ],
            [
                "code" => "GD",
                "name_en" => " Grenada",
                "name_ar" => "غرينادا",
                "nationality_en" => "Grenadian",
                "nationality_ar" => "غرينادي"
            ],
            [
                "code" => "GP",
                "name_en" => " Guadeloupe",
                "name_ar" => "جزر جوادلوب",
                "nationality_en" => "Guadeloupe",
                "nationality_ar" => "جزر جوادلوب"
            ],
            [
                "code" => "GU",
                "name_en" => " Guam",
                "name_ar" => "جوام",
                "nationality_en" => "Guamanian",
                "nationality_ar" => "جوامي"
            ],
            [
                "code" => "GT",
                "name_en" => " Guatemala",
                "name_ar" => "غواتيمال",
                "nationality_en" => "Guatemalan",
                "nationality_ar" => "غواتيمالي"
            ],
            [
                "code" => "GN",
                "name_en" => " Guinea",
                "name_ar" => "غينيا",
                "nationality_en" => "Guinean",
                "nationality_ar" => "غيني"
            ],
            [
                "code" => "GW",
                "name_en" => " Guinea-Bissau",
                "name_ar" => "غينيا-بيساو",
                "nationality_en" => "Guinea-Bissauan",
                "nationality_ar" => "غيني"
            ],
            [
                "code" => "GY",
                "name_en" => " Guyana",
                "name_ar" => "غيانا",
                "nationality_en" => "Guyanese",
                "nationality_ar" => "غياني"
            ],
            [
                "code" => "HT",
                "name_en" => " Haiti",
                "name_ar" => "هايتي",
                "nationality_en" => "Haitian",
                "nationality_ar" => "هايتي"
            ],
            [
                "code" => "HM",
                "name_en" => " Heard and Mc Donald Islands",
                "name_ar" => "جزيرة هيرد وجزر ماكدونالد",
                "nationality_en" => "Heard and Mc Donald Islanders",
                "nationality_ar" => "جزيرة هيرد وجزر ماكدونالد"
            ],
            [
                "code" => "HN",
                "name_en" => " Honduras",
                "name_ar" => "هندوراس",
                "nationality_en" => "Honduran",
                "nationality_ar" => "هندوراسي"
            ],
            [
                "code" => "HK",
                "name_en" => " Hong Kong",
                "name_ar" => "هونغ كونغ",
                "nationality_en" => "Hongkongese",
                "nationality_ar" => "هونغ كونغي"
            ],
            [
                "code" => "HU",
                "name_en" => " Hungary",
                "name_ar" => "المجر",
                "nationality_en" => "Hungarian",
                "nationality_ar" => "مجري"
            ],
            [
                "code" => "IS",
                "name_en" => " Iceland",
                "name_ar" => "آيسلندا",
                "nationality_en" => "Icelandic",
                "nationality_ar" => "آيسلندي"
            ],
            [
                "code" => "IN",
                "name_en" => " India",
                "name_ar" => "الهند",
                "nationality_en" => "Indian",
                "nationality_ar" => "هندي"
            ],
            [
                "code" => "IM",
                "name_en" => " Isle of Man",
                "name_ar" => "جزيرة مان",
                "nationality_en" => "Manx",
                "nationality_ar" => "ماني"
            ],
            [
                "code" => "ID",
                "name_en" => " Indonesia",
                "name_ar" => "أندونيسيا",
                "nationality_en" => "Indonesian",
                "nationality_ar" => "أندونيسيي"
            ],
            [
                "code" => "IR",
                "name_en" => " Iran",
                "name_ar" => "إيران",
                "nationality_en" => "Iranian",
                "nationality_ar" => "إيراني"
            ],
            [
                "code" => "IQ",
                "name_en" => " Iraq",
                "name_ar" => "العراق",
                "nationality_en" => "Iraqi",
                "nationality_ar" => "عراقي"
            ],
            [
                "code" => "IE",
                "name_en" => " Ireland",
                "name_ar" => "إيرلندا",
                "nationality_en" => "Irish",
                "nationality_ar" => "إيرلندي"
            ],
            [
                "code" => "IT",
                "name_en" => " Italy",
                "name_ar" => "إيطاليا",
                "nationality_en" => "Italian",
                "nationality_ar" => "إيطالي"
            ],
            [
                "code" => "CI",
                "name_en" => " Ivory Coast",
                "name_ar" => "ساحل العاج",
                "nationality_en" => "Ivory Coastian",
                "nationality_ar" => "ساحل العاج"
            ],
            [
                "code" => "JE",
                "name_en" => " Jersey",
                "name_ar" => "جيرزي",
                "nationality_en" => "Jersian",
                "nationality_ar" => "جيرزي"
            ],
            [
                "code" => "JM",
                "name_en" => " Jamaica",
                "name_ar" => "جمايكا",
                "nationality_en" => "Jamaican",
                "nationality_ar" => "جمايكي"
            ],
            [
                "code" => "JP",
                "name_en" => " Japan",
                "name_ar" => "اليابان",
                "nationality_en" => "Japanese",
                "nationality_ar" => "ياباني"
            ],
            [
                "code" => "JO",
                "name_en" => " Jordan",
                "name_ar" => "الأردن",
                "nationality_en" => "Jordanian",
                "nationality_ar" => "أردني"
            ],
            [
                "code" => "KZ",
                "name_en" => " Kazakhstan",
                "name_ar" => "كازاخستان",
                "nationality_en" => "Kazakh",
                "nationality_ar" => "كازاخستاني"
            ],
            [
                "code" => "KE",
                "name_en" => " Kenya",
                "name_ar" => "كينيا",
                "nationality_en" => "Kenyan",
                "nationality_ar" => "كيني"
            ],
            [
                "code" => "KI",
                "name_en" => " Kiribati",
                "name_ar" => "كيريباتي",
                "nationality_en" => "I-Kiribati",
                "nationality_ar" => "كيريباتي"
            ],
            [
                "code" => "KP",
                "name_en" => " Korea(North Korea)",
                "name_ar" => "كوريا الشمالية",
                "nationality_en" => "North Korean",
                "nationality_ar" => "كوري"
            ],
            [
                "code" => "KR",
                "name_en" => " Korea(South Korea)",
                "name_ar" => "كوريا الجنوبية",
                "nationality_en" => "South Korean",
                "nationality_ar" => "كوري"
            ],
            [
                "code" => "XK",
                "name_en" => " Kosovo",
                "name_ar" => "كوسوفو",
                "nationality_en" => "Kosovar",
                "nationality_ar" => "كوسيفي"
            ],
            [
                "code" => "KW",
                "name_en" => " Kuwait",
                "name_ar" => "الكويت",
                "nationality_en" => "Kuwaiti",
                "nationality_ar" => "كويتي"
            ],
            [
                "code" => "KG",
                "name_en" => " Kyrgyzstan",
                "name_ar" => "قيرغيزستان",
                "nationality_en" => "Kyrgyzstani",
                "nationality_ar" => "قيرغيزستاني"
            ],
            [
                "code" => "LA",
                "name_en" => " Lao PDR",
                "name_ar" => "لاوس",
                "nationality_en" => "Laotian",
                "nationality_ar" => "لاوسي"
            ],
            [
                "code" => "LV",
                "name_en" => " Latvia",
                "name_ar" => "لاتفيا",
                "nationality_en" => "Latvian",
                "nationality_ar" => "لاتيفي"
            ],
            [
                "code" => "LB",
                "name_en" => " Lebanon",
                "name_ar" => "لبنان",
                "nationality_en" => "Lebanese",
                "nationality_ar" => "لبناني"
            ],
            [
                "code" => "LS",
                "name_en" => " Lesotho",
                "name_ar" => "ليسوتو",
                "nationality_en" => "Basotho",
                "nationality_ar" => "ليوسيتي"
            ],
            [
                "code" => "LR",
                "name_en" => " Liberia",
                "name_ar" => "ليبيريا",
                "nationality_en" => "Liberian",
                "nationality_ar" => "ليبيري"
            ],
            [
                "code" => "LY",
                "name_en" => " Libya",
                "name_ar" => "ليبيا",
                "nationality_en" => "Libyan",
                "nationality_ar" => "ليبي"
            ],
            [
                "code" => "LI",
                "name_en" => " Liechtenstein",
                "name_ar" => "ليختنشتين",
                "nationality_en" => "Liechtenstein",
                "nationality_ar" => "ليختنشتيني"
            ],
            [
                "code" => "LT",
                "name_en" => " Lithuania",
                "name_ar" => "لتوانيا",
                "nationality_en" => "Lithuanian",
                "nationality_ar" => "لتوانيي"
            ],
            [
                "code" => "LU",
                "name_en" => " Luxembourg",
                "name_ar" => "لوكسمبورغ",
                "nationality_en" => "Luxembourger",
                "nationality_ar" => "لوكسمبورغي"
            ],
            [
                "code" => "LK",
                "name_en" => " Sri Lanka",
                "name_ar" => "سريلانكا",
                "nationality_en" => "Sri Lankian",
                "nationality_ar" => "سريلانكي"
            ],
            [
                "code" => "MO",
                "name_en" => " Macau",
                "name_ar" => "ماكاو",
                "nationality_en" => "Macanese",
                "nationality_ar" => "ماكاوي"
            ],
            [
                "code" => "MK",
                "name_en" => " Macedonia",
                "name_ar" => "مقدونيا",
                "nationality_en" => "Macedonian",
                "nationality_ar" => "مقدوني"
            ],
            [
                "code" => "MG",
                "name_en" => " Madagascar",
                "name_ar" => "مدغشقر",
                "nationality_en" => "Malagasy",
                "nationality_ar" => "مدغشقري"
            ],
            [
                "code" => "MW",
                "name_en" => " Malawi",
                "name_ar" => "مالاوي",
                "nationality_en" => "Malawian",
                "nationality_ar" => "مالاوي"
            ],
            [
                "code" => "MY",
                "name_en" => " Malaysia",
                "name_ar" => "ماليزيا",
                "nationality_en" => "Malaysian",
                "nationality_ar" => "ماليزي"
            ],
            [
                "code" => "MV",
                "name_en" => " Maldives",
                "name_ar" => "المالديف",
                "nationality_en" => "Maldivian",
                "nationality_ar" => "مالديفي"
            ],
            [
                "code" => "ML",
                "name_en" => " Mali",
                "name_ar" => "مالي",
                "nationality_en" => "Malian",
                "nationality_ar" => "مالي"
            ],
            [
                "code" => "MT",
                "name_en" => " Malta",
                "name_ar" => "مالطا",
                "nationality_en" => "Maltese",
                "nationality_ar" => "مالطي"
            ],
            [
                "code" => "MH",
                "name_en" => " Marshall Islands",
                "name_ar" => "جزر مارشال",
                "nationality_en" => "Marshallese",
                "nationality_ar" => "مارشالي"
            ],
            [
                "code" => "MQ",
                "name_en" => " Martinique",
                "name_ar" => "مارتينيك",
                "nationality_en" => "Martiniquais",
                "nationality_ar" => "مارتينيكي"
            ],
            [
                "code" => "MR",
                "name_en" => " Mauritania",
                "name_ar" => "موريتانيا",
                "nationality_en" => "Mauritanian",
                "nationality_ar" => "موريتانيي"
            ],
            [
                "code" => "MU",
                "name_en" => " Mauritius",
                "name_ar" => "موريشيوس",
                "nationality_en" => "Mauritian",
                "nationality_ar" => "موريشيوسي"
            ],
            [
                "code" => "YT",
                "name_en" => " Mayotte",
                "name_ar" => "مايوت",
                "nationality_en" => "Mahoran",
                "nationality_ar" => "مايوتي"
            ],
            [
                "code" => "MX",
                "name_en" => " Mexico",
                "name_ar" => "المكسيك",
                "nationality_en" => "Mexican",
                "nationality_ar" => "مكسيكي"
            ],
            [
                "code" => "FM",
                "name_en" => " Micronesia",
                "name_ar" => "مايكرونيزيا",
                "nationality_en" => "Micronesian",
                "nationality_ar" => "مايكرونيزيي"
            ],
            [
                "code" => "MD",
                "name_en" => " Moldova",
                "name_ar" => "مولدافيا",
                "nationality_en" => "Moldovan",
                "nationality_ar" => "مولديفي"
            ],
            [
                "code" => "MC",
                "name_en" => " Monaco",
                "name_ar" => "موناكو",
                "nationality_en" => "Monacan",
                "nationality_ar" => "مونيكي"
            ],
            [
                "code" => "MN",
                "name_en" => " Mongolia",
                "name_ar" => "منغوليا",
                "nationality_en" => "Mongolian",
                "nationality_ar" => "منغولي"
            ],
            [
                "code" => "ME",
                "name_en" => " Montenegro",
                "name_ar" => "الجبل الأسود",
                "nationality_en" => "Montenegrin",
                "nationality_ar" => "الجبل الأسود"
            ],
            [
                "code" => "MS",
                "name_en" => " Montserrat",
                "name_ar" => "مونتسيرات",
                "nationality_en" => "Montserratian",
                "nationality_ar" => "مونتسيراتي"
            ],
            [
                "code" => "MA",
                "name_en" => " Morocco",
                "name_ar" => "المغرب",
                "nationality_en" => "Moroccan",
                "nationality_ar" => "مغربي"
            ],
            [
                "code" => "MZ",
                "name_en" => " Mozambique",
                "name_ar" => "موزمبيق",
                "nationality_en" => "Mozambican",
                "nationality_ar" => "موزمبيقي"
            ],
            [
                "code" => "MM",
                "name_en" => " Myanmar",
                "name_ar" => "ميانمار",
                "nationality_en" => "Myanmarian",
                "nationality_ar" => "ميانماري"
            ],
            [
                "code" => "NA",
                "name_en" => " Namibia",
                "name_ar" => "ناميبيا",
                "nationality_en" => "Namibian",
                "nationality_ar" => "ناميبي"
            ],
            [
                "code" => "NR",
                "name_en" => " Nauru",
                "name_ar" => "نورو",
                "nationality_en" => "Nauruan",
                "nationality_ar" => "نوري"
            ],
            [
                "code" => "NP",
                "name_en" => " Nepal",
                "name_ar" => "نيبال",
                "nationality_en" => "Nepalese",
                "nationality_ar" => "نيبالي"
            ],
            [
                "code" => "NL",
                "name_en" => " Netherlands",
                "name_ar" => "هولندا",
                "nationality_en" => "Dutch",
                "nationality_ar" => "هولندي"
            ],
            [
                "code" => "AN",
                "name_en" => " Netherlands Antilles",
                "name_ar" => "جزر الأنتيل الهولندي",
                "nationality_en" => "Dutch Antilier",
                "nationality_ar" => "هولندي"
            ],
            [
                "code" => "NC",
                "name_en" => " New Caledonia",
                "name_ar" => "كاليدونيا الجديدة",
                "nationality_en" => "New Caledonian",
                "nationality_ar" => "كاليدوني"
            ],
            [
                "code" => "NZ",
                "name_en" => " New Zealand",
                "name_ar" => "نيوزيلندا",
                "nationality_en" => "New Zealander",
                "nationality_ar" => "نيوزيلندي"
            ],
            [
                "code" => "NI",
                "name_en" => " Nicaragua",
                "name_ar" => "نيكاراجوا",
                "nationality_en" => "Nicaraguan",
                "nationality_ar" => "نيكاراجوي"
            ],
            [
                "code" => "NE",
                "name_en" => " Niger",
                "name_ar" => "النيجر",
                "nationality_en" => "Nigerien",
                "nationality_ar" => "نيجيري"
            ],
            [
                "code" => "NG",
                "name_en" => " Nigeria",
                "name_ar" => "نيجيريا",
                "nationality_en" => "Nigerian",
                "nationality_ar" => "نيجيري"
            ],
            [
                "code" => "NU",
                "name_en" => " Niue",
                "name_ar" => "ني",
                "nationality_en" => "Niuean",
                "nationality_ar" => "ني"
            ],
            [
                "code" => "NF",
                "name_en" => " Norfolk Island",
                "name_ar" => "جزيرة نورفولك",
                "nationality_en" => "Norfolk Islander",
                "nationality_ar" => "نورفوليكي"
            ],
            [
                "code" => "MP",
                "name_en" => " Northern Mariana Islands",
                "name_ar" => "جزر ماريانا الشمالية",
                "nationality_en" => "Northern Marianan",
                "nationality_ar" => "ماريني"
            ],
            [
                "code" => "NO",
                "name_en" => " Norway",
                "name_ar" => "النرويج",
                "nationality_en" => "Norwegian",
                "nationality_ar" => "نرويجي"
            ],
            [
                "code" => "OM",
                "name_en" => " Oman",
                "name_ar" => "عمان",
                "nationality_en" => "Omani",
                "nationality_ar" => "عماني"
            ],
            [
                "code" => "PK",
                "name_en" => " Pakistan",
                "name_ar" => "باكستان",
                "nationality_en" => "Pakistani",
                "nationality_ar" => "باكستاني"
            ],
            [
                "code" => "PW",
                "name_en" => " Palau",
                "name_ar" => "بالاو",
                "nationality_en" => "Palauan",
                "nationality_ar" => "بالاوي"
            ],
            [
                "code" => "PS",
                "name_en" => " Palestine",
                "name_ar" => "فلسطين",
                "nationality_en" => "Palestinian",
                "nationality_ar" => "فلسطيني"
            ],
            [
                "code" => "PA",
                "name_en" => " Panama",
                "name_ar" => "بنما",
                "nationality_en" => "Panamanian",
                "nationality_ar" => "بنمي"
            ],
            [
                "code" => "PG",
                "name_en" => " Papua New Guinea",
                "name_ar" => "بابوا غينيا الجديدة",
                "nationality_en" => "Papua New Guinean",
                "nationality_ar" => "بابوي"
            ],
            [
                "code" => "PY",
                "name_en" => " Paraguay",
                "name_ar" => "باراغواي",
                "nationality_en" => "Paraguayan",
                "nationality_ar" => "بارغاوي"
            ],
            [
                "code" => "PE",
                "name_en" => " Peru",
                "name_ar" => "بيرو",
                "nationality_en" => "Peruvian",
                "nationality_ar" => "بيري"
            ],
            [
                "code" => "PH",
                "name_en" => " Philippines",
                "name_ar" => "الفليبين",
                "nationality_en" => "Filipino",
                "nationality_ar" => "فلبيني"
            ],
            [
                "code" => "PN",
                "name_en" => " Pitcairn",
                "name_ar" => "بيتكيرن",
                "nationality_en" => "Pitcairn Islander",
                "nationality_ar" => "بيتكيرني"
            ],
            [
                "code" => "PL",
                "name_en" => " Poland",
                "name_ar" => "بولونيا",
                "nationality_en" => "Polish",
                "nationality_ar" => "بوليني"
            ],
            [
                "code" => "PT",
                "name_en" => " Portugal",
                "name_ar" => "البرتغال",
                "nationality_en" => "Portuguese",
                "nationality_ar" => "برتغالي"
            ],
            [
                "code" => "PR",
                "name_en" => " Puerto Rico",
                "name_ar" => "بورتو ريكو",
                "nationality_en" => "Puerto Rican",
                "nationality_ar" => "بورتي"
            ],
            [
                "code" => "QA",
                "name_en" => " Qatar",
                "name_ar" => "قطر",
                "nationality_en" => "Qatari",
                "nationality_ar" => "قطري"
            ],
            [
                "code" => "RE",
                "name_en" => " Reunion Island",
                "name_ar" => "ريونيون",
                "nationality_en" => "Reunionese",
                "nationality_ar" => "ريونيوني"
            ],
            [
                "code" => "RO",
                "name_en" => " Romania",
                "name_ar" => "رومانيا",
                "nationality_en" => "Romanian",
                "nationality_ar" => "روماني"
            ],
            [
                "code" => "RU",
                "name_en" => " Russian",
                "name_ar" => "روسيا",
                "nationality_en" => "Russian",
                "nationality_ar" => "روسي"
            ],
            [
                "code" => "RW",
                "name_en" => " Rwanda",
                "name_ar" => "رواندا",
                "nationality_en" => "Rwandan",
                "nationality_ar" => "رواندا"
            ],
            [
                "code" => "KN",
                "name_en" => " Saint Kitts and Nevis",
                "name_ar" => "سانت كيتس ونيفس",
                "nationality_en" => "",
                "nationality_ar" => "Kittitian/Nevisian"
            ],
            [
                "code" => "MF",
                "name_en" => " Saint Martin (French part)",
                "name_ar" => "ساينت مارتن فرنسي",
                "nationality_en" => "St. Martian(French)",
                "nationality_ar" => "ساينت مارتني فرنسي"
            ],
            [
                "code" => "SX",
                "name_en" => " Sint Maarten (Dutch part)",
                "name_ar" => "ساينت مارتن هولندي",
                "nationality_en" => "St. Martian(Dutch)",
                "nationality_ar" => "ساينت مارتني هولندي"
            ],
            [
                "code" => "LC",
                "name_en" => " Saint Pierre and Miquelon",
                "name_ar" => "سان بيير وميكلون",
                "nationality_en" => "St. Pierre and Miquelon",
                "nationality_ar" => "سان بيير وميكلوني"
            ],
            [
                "code" => "VC",
                "name_en" => " Saint Vincent and the Grenadines",
                "name_ar" => "سانت فنسنت وجزر غرينادين",
                "nationality_en" => "Saint Vincent and the Grenadines",
                "nationality_ar" => "سانت فنسنت وجزر غرينادين"
            ],
            [
                "code" => "WS",
                "name_en" => " Samoa",
                "name_ar" => "ساموا",
                "nationality_en" => "Samoan",
                "nationality_ar" => "ساموي"
            ],
            [
                "code" => "SM",
                "name_en" => " San Marino",
                "name_ar" => "سان مارينو",
                "nationality_en" => "Sammarinese",
                "nationality_ar" => "ماريني"
            ],
            [
                "code" => "ST",
                "name_en" => " Sao Tome and Principe",
                "name_ar" => "ساو تومي وبرينسيبي",
                "nationality_en" => "Sao Tomean",
                "nationality_ar" => "ساو تومي وبرينسيبي"
            ],
            [
                "code" => "SA",
                "name_en" => " Saudi Arabia",
                "name_ar" => "المملكة العربية السعودية",
                "nationality_en" => "Saudi Arabian",
                "nationality_ar" => "سعودي"
            ],
            [
                "code" => "SN",
                "name_en" => " Senegal",
                "name_ar" => "السنغال",
                "nationality_en" => "Senegalese",
                "nationality_ar" => "سنغالي"
            ],
            [
                "code" => "RS",
                "name_en" => " Serbia",
                "name_ar" => "صربيا",
                "nationality_en" => "Serbian",
                "nationality_ar" => "صربي"
            ],
            [
                "code" => "SC",
                "name_en" => " Seychelles",
                "name_ar" => "سيشيل",
                "nationality_en" => "Seychellois",
                "nationality_ar" => "سيشيلي"
            ],
            [
                "code" => "SL",
                "name_en" => " Sierra Leone",
                "name_ar" => "سيراليون",
                "nationality_en" => "Sierra Leonean",
                "nationality_ar" => "سيراليوني"
            ],
            [
                "code" => "SG",
                "name_en" => " Singapore",
                "name_ar" => "سنغافورة",
                "nationality_en" => "Singaporean",
                "nationality_ar" => "سنغافوري"
            ],
            [
                "code" => "SK",
                "name_en" => " Slovakia",
                "name_ar" => "سلوفاكيا",
                "nationality_en" => "Slovak",
                "nationality_ar" => "سولفاكي"
            ],
            [
                "code" => "SI",
                "name_en" => " Slovenia",
                "name_ar" => "سلوفينيا",
                "nationality_en" => "Slovenian",
                "nationality_ar" => "سولفيني"
            ],
            [
                "code" => "SB",
                "name_en" => " Solomon Islands",
                "name_ar" => "جزر سليمان",
                "nationality_en" => "Solomon Island",
                "nationality_ar" => "جزر سليمان"
            ],
            [
                "code" => "SO",
                "name_en" => " Somalia",
                "name_ar" => "الصومال",
                "nationality_en" => "Somali",
                "nationality_ar" => "صومالي"
            ],
            [
                "code" => "ZA",
                "name_en" => " South Africa",
                "name_ar" => "جنوب أفريقيا",
                "nationality_en" => "South African",
                "nationality_ar" => "أفريقي"
            ],
            [
                "code" => "GS",
                "name_en" => " South Georgia and the South Sandwich",
                "name_ar" => "المنطقة القطبية الجنوبية",
                "nationality_en" => "South Georgia and the South Sandwich",
                "nationality_ar" => "لمنطقة القطبية الجنوبية"
            ],
            [
                "code" => "SS",
                "name_en" => " South Sudan",
                "name_ar" => "السودان الجنوبي",
                "nationality_en" => "South Sudanese",
                "nationality_ar" => "سوادني جنوبي"
            ],
            [
                "code" => "ES",
                "name_en" => " Spain",
                "name_ar" => "إسبانيا",
                "nationality_en" => "Spanish",
                "nationality_ar" => "إسباني"
            ],
            [
                "code" => "SH",
                "name_en" => " Saint Helena",
                "name_ar" => "سانت هيلانة",
                "nationality_en" => "St. Helenian",
                "nationality_ar" => "هيلاني"
            ],
            [
                "code" => "SD",
                "name_en" => " Sudan",
                "name_ar" => "السودان",
                "nationality_en" => "Sudanese",
                "nationality_ar" => "سوداني"
            ],
            [
                "code" => "SR",
                "name_en" => " Suriname",
                "name_ar" => "سورينام",
                "nationality_en" => "Surinamese",
                "nationality_ar" => "سورينامي"
            ],
            [
                "code" => "SJ",
                "name_en" => " Svalbard and Jan Mayen",
                "name_ar" => "سفالبارد ويان ماين",
                "nationality_en" => "Svalbardian/Jan Mayenian",
                "nationality_ar" => "سفالبارد ويان ماين"
            ],
            [
                "code" => "SZ",
                "name_en" => " Swaziland",
                "name_ar" => "سوازيلند",
                "nationality_en" => "Swazi",
                "nationality_ar" => "سوازيلندي"
            ],
            [
                "code" => "SE",
                "name_en" => " Sweden",
                "name_ar" => "السويد",
                "nationality_en" => "Swedish",
                "nationality_ar" => "سويدي"
            ],
            [
                "code" => "CH",
                "name_en" => " Switzerland",
                "name_ar" => "سويسرا",
                "nationality_en" => "Swiss",
                "nationality_ar" => "سويسري"
            ],
            [
                "code" => "SY",
                "name_en" => " Syria",
                "name_ar" => "سوريا",
                "nationality_en" => "Syrian",
                "nationality_ar" => "سوري"
            ],
            [
                "code" => "TW",
                "name_en" => " Taiwan",
                "name_ar" => "تايوان",
                "nationality_en" => "Taiwanese",
                "nationality_ar" => "تايواني"
            ],
            [
                "code" => "TJ",
                "name_en" => " Tajikistan",
                "name_ar" => "طاجيكستان",
                "nationality_en" => "Tajikistani",
                "nationality_ar" => "طاجيكستاني"
            ],
            [
                "code" => "TZ",
                "name_en" => " Tanzania",
                "name_ar" => "تنزانيا",
                "nationality_en" => "Tanzanian",
                "nationality_ar" => "تنزانيي"
            ],
            [
                "code" => "TH",
                "name_en" => " Thailand",
                "name_ar" => "تايلندا",
                "nationality_en" => "Thai",
                "nationality_ar" => "تايلندي"
            ],
            [
                "code" => "TL",
                "name_en" => " Timor-Leste",
                "name_ar" => "تيمور الشرقية",
                "nationality_en" => "Timor-Lestian",
                "nationality_ar" => "تيموري"
            ],
            [
                "code" => "TG",
                "name_en" => " Togo",
                "name_ar" => "توغو",
                "nationality_en" => "Togolese",
                "nationality_ar" => "توغي"
            ],
            [
                "code" => "TK",
                "name_en" => " Tokelau",
                "name_ar" => "توكيلاو",
                "nationality_en" => "Tokelaian",
                "nationality_ar" => "توكيلاوي"
            ],
            [
                "code" => "TO",
                "name_en" => " Tonga",
                "name_ar" => "تونغا",
                "nationality_en" => "Tongan",
                "nationality_ar" => "تونغي"
            ],
            [
                "code" => "TT",
                "name_en" => " Trinidad and Tobago",
                "name_ar" => "ترينيداد وتوباغو",
                "nationality_en" => "Trinidadian/Tobagonian",
                "nationality_ar" => "ترينيداد وتوباغو"
            ],
            [
                "code" => "TN",
                "name_en" => " Tunisia",
                "name_ar" => "تونس",
                "nationality_en" => "Tunisian",
                "nationality_ar" => "تونسي"
            ],
            [
                "code" => "TR",
                "name_en" => " Turkey",
                "name_ar" => "تركيا",
                "nationality_en" => "Turkish",
                "nationality_ar" => "تركي"
            ],
            [
                "code" => "TM",
                "name_en" => " Turkmenistan",
                "name_ar" => "تركمانستان",
                "nationality_en" => "Turkmen",
                "nationality_ar" => "تركمانستاني"
            ],
            [
                "code" => "TC",
                "name_en" => " Turks and Caicos Islands",
                "name_ar" => "جزر توركس وكايكوس",
                "nationality_en" => "Turks and Caicos Islands",
                "nationality_ar" => "جزر توركس وكايكوس"
            ],
            [
                "code" => "TV",
                "name_en" => " Tuvalu",
                "name_ar" => "توفالو",
                "nationality_en" => "Tuvaluan",
                "nationality_ar" => "توفالي"
            ],
            [
                "code" => "UG",
                "name_en" => " Uganda",
                "name_ar" => "أوغندا",
                "nationality_en" => "Ugandan",
                "nationality_ar" => "أوغندي"
            ],
            [
                "code" => "UA",
                "name_en" => " Ukraine",
                "name_ar" => "أوكرانيا",
                "nationality_en" => "Ukrainian",
                "nationality_ar" => "أوكراني"
            ],
            [
                "code" => "AE",
                "name_en" => " United Arab Emirates",
                "name_ar" => "الإمارات العربية المتحدة",
                "nationality_en" => "Emirati",
                "nationality_ar" => "إماراتي"
            ],
            [
                "code" => "GB",
                "name_en" => " United Kingdom",
                "name_ar" => "المملكة المتحدة",
                "nationality_en" => "British",
                "nationality_ar" => "بريطاني"
            ],
            [
                "code" => "US",
                "name_en" => " United States",
                "name_ar" => "الولايات المتحدة",
                "nationality_en" => "American",
                "nationality_ar" => "أمريكي"
            ],
            [
                "code" => "UM",
                "name_en" => " US Minor Outlying Islands",
                "name_ar" => "قائمة الولايات والمناطق الأمريكية",
                "nationality_en" => "US Minor Outlying Islander",
                "nationality_ar" => "أمريكي"
            ],
            [
                "code" => "UY",
                "name_en" => " Uruguay",
                "name_ar" => "أورغواي",
                "nationality_en" => "Uruguayan",
                "nationality_ar" => "أورغواي"
            ],
            [
                "code" => "UZ",
                "name_en" => " Uzbekistan",
                "name_ar" => "أوزباكستان",
                "nationality_en" => "Uzbek",
                "nationality_ar" => "أوزباكستاني"
            ],
            [
                "code" => "VU",
                "name_en" => " Vanuatu",
                "name_ar" => "فانواتو",
                "nationality_en" => "Vanuatuan",
                "nationality_ar" => "فانواتي"
            ],
            [
                "code" => "VE",
                "name_en" => " Venezuela",
                "name_ar" => "فنزويلا",
                "nationality_en" => "Venezuelan",
                "nationality_ar" => "فنزويلي"
            ],
            [
                "code" => "VN",
                "name_en" => " Vietnam",
                "name_ar" => "فيتنام",
                "nationality_en" => "Vietnamese",
                "nationality_ar" => "فيتنامي"
            ],
            [
                "code" => "VI",
                "name_en" => " Virgin Islands (U.S.)",
                "name_ar" => "الجزر العذراء الأمريكي",
                "nationality_en" => "American Virgin Islander",
                "nationality_ar" => "أمريكي"
            ],
            [
                "code" => "VA",
                "name_en" => " Vatican City",
                "name_ar" => "فنزويلا",
                "nationality_en" => "Vatican",
                "nationality_ar" => "فاتيكاني"
            ],
            [
                "code" => "WF",
                "name_en" => " Wallis and Futuna Islands",
                "name_ar" => "والس وفوتونا",
                "nationality_en" => "Wallisian/Futunan",
                "nationality_ar" => "فوتوني"
            ],
            [
                "code" => "EH",
                "name_en" => " Western Sahara",
                "name_ar" => "الصحراء الغربية",
                "nationality_en" => "Sahrawian",
                "nationality_ar" => "صحراوي"
            ],
            [
                "code" => "YE",
                "name_en" => " Yemen",
                "name_ar" => "اليمن",
                "nationality_en" => "Yemeni",
                "nationality_ar" => "يمني"
            ],
            [
                "code" => "ZM",
                "name_en" => " Zambia",
                "name_ar" => "زامبيا",
                "nationality_en" => "Zambian",
                "nationality_ar" => "زامبياني"
            ],
            [
                "code" => "ZW",
                "name_en" => " Zimbabwe",
                "name_ar" => "زمبابوي",
                "nationality_en" => "Zimbabwean",
                "nationality_ar" => "زمبابوي"
            ]
        ];
        Country::query()->insert($countries);
    }
}