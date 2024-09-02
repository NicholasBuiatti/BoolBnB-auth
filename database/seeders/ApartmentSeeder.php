<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;



class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newApartment = new Apartment();
        $newApartment->user_id = 1;
        $newApartment->title = "villetta 1";
        $newApartment->rooms = 3;
        $newApartment->beds = 2;
        $newApartment->bathrooms = 1;
        $newApartment->dimension_mq = 50;
        $newApartment->image = "http://www.case-in-legno-progettolegno.it/wp-content/uploads/2015/12/Casa-in-legno-a-Fano-0003.jpg";
        $newApartment->latitude = 45.4642;
        $newApartment->longitude = 45.4642;
        $newApartment->address_full = "via dei matti,0,11111,Milano";
        $newApartment->is_visible = true;
        $newApartment->save();

        $newApartment = new Apartment();
        $newApartment->user_id = 2;
        $newApartment->title = "Casa Fiorita";
        $newApartment->rooms = 4;
        $newApartment->beds = 3;
        $newApartment->bathrooms = 2;
        $newApartment->dimension_mq = 75;
        $newApartment->image = "https://www.arredamento.it/le-case-bellissime_NG2.jpg";
        $newApartment->latitude = 45.4652;
        $newApartment->longitude = 45.4652;
        $newApartment->address_full = "via dei fiori,10,22222,Milano";
        $newApartment->is_visible = true;
        $newApartment->save();

        $newApartment = new Apartment();
        $newApartment->user_id = 3;
        $newApartment->title = "Residenza Rosa";
        $newApartment->rooms = 2;
        $newApartment->beds = 1;
        $newApartment->bathrooms = 1;
        $newApartment->dimension_mq = 45;
        $newApartment->image = "https://images.tuscany-villas.it/vacation_rentals/79657/xwide/villa-le-palme-esterni-15.jpg";
        $newApartment->latitude = 45.4662;
        $newApartment->longitude = 45.4662;
        $newApartment->address_full = "via delle rose,15,33333,Milano";
        $newApartment->is_visible = true;
        $newApartment->save();

        $newApartment = new Apartment();
        $newApartment->user_id = 1;
        $newApartment->title = "Villa Ulivi";
        $newApartment->rooms = 3;
        $newApartment->beds = 2;
        $newApartment->bathrooms = 1;
        $newApartment->dimension_mq = 55;
        $newApartment->image = "https://www.costantinilegno.it/wp-content/uploads/2015/11/LACOST-Case-in-legno-umbria2.jpg";
        $newApartment->latitude = 45.4672;
        $newApartment->longitude = 45.4672;
        $newApartment->address_full = "via degli ulivi,20,44444,Milano";
        $newApartment->is_visible = true;
        $newApartment->save();

        $newApartment = new Apartment();
        $newApartment->user_id = 2;
        $newApartment->title = "Villa Tiglio";
        $newApartment->rooms = 5;
        $newApartment->beds = 4;
        $newApartment->bathrooms = 3;
        $newApartment->dimension_mq = 100;
        $newApartment->image = "https://itacanotizie.it/wp-content/uploads/2020/04/1560857854_villa_under_construction_barban_istra1.jpg";
        $newApartment->latitude = 45.4682;
        $newApartment->longitude = 45.4682;
        $newApartment->address_full = "via dei tigli,25,55555,Milano";
        $newApartment->is_visible = true;
        $newApartment->save();

        $newApartment = new Apartment();
        $newApartment->user_id = 3;
        $newApartment->title = "Casa Magnolia";
        $newApartment->rooms = 1;
        $newApartment->beds = 1;
        $newApartment->bathrooms = 1;
        $newApartment->dimension_mq = 35;
        $newApartment->image = "https://i.pinimg.com/originals/34/5b/e1/345be18e88f164caad46e3f849b43626.jpg";
        $newApartment->latitude = 45.4692;
        $newApartment->longitude = 45.4692;
        $newApartment->address_full = "via delle magnolie,30,66666,Milano";
        $newApartment->is_visible = true;
        $newApartment->save();

        $newApartment = new Apartment();
        $newApartment->user_id = 1;
        $newApartment->title = "Casa degli Aranci";
        $newApartment->rooms = 3;
        $newApartment->beds = 2;
        $newApartment->bathrooms = 2;
        $newApartment->dimension_mq = 65;
        $newApartment->image = "https://www.lignius.it/images/_processed_/d/0/csm_lignius-rubner-haus_02_5a3164153c.jpg";
        $newApartment->latitude = 45.4702;
        $newApartment->longitude = 45.4702;
        $newApartment->address_full = "via degli aranci,35,77777,Milano";
        $newApartment->is_visible = true;
        $newApartment->save();

        $newApartment = new Apartment();
        $newApartment->user_id = 2;
        $newApartment->title = "Residenza Pini";
        $newApartment->rooms = 2;
        $newApartment->beds = 1;
        $newApartment->bathrooms = 1;
        $newApartment->dimension_mq = 40;
        $newApartment->image = "https://4.bp.blogspot.com/-nNbDz0n4Uu4/VY1hZy6bMII/AAAAAAAADVY/rKMhPngoCb0/s1600/corfu-villa-edoardo-luxury-fa%25C3%25A7ade";
        $newApartment->latitude = 45.4712;
        $newApartment->longitude = 45.4712;
        $newApartment->address_full = "via dei pini,40,88888,Milano";
        $newApartment->is_visible = true;
        $newApartment->save();

        $newApartment = new Apartment();
        $newApartment->user_id = 3;
        $newApartment->title = "Villa Cipressi";
        $newApartment->rooms = 4;
        $newApartment->beds = 3;
        $newApartment->bathrooms = 2;
        $newApartment->dimension_mq = 85;
        $newApartment->image = "https://images.homify.com/images/a_0,c_fit,f_auto,q_auto,w_1108/v1448264950/p/photo/image/1136307/037_Montecarlo_MG_0581-2_ab/foto-di-in-stile-di.jpg";
        $newApartment->latitude = 45.4722;
        $newApartment->longitude = 45.4722;
        $newApartment->address_full = "via dei cipressi,45,99999,Milano";
        $newApartment->is_visible = true;
        $newApartment->save();

        $newApartment = new Apartment();
        $newApartment->user_id = 1;
        $newApartment->title = "Villa Castagni";
        $newApartment->rooms = 3;
        $newApartment->beds = 2;
        $newApartment->bathrooms = 1;
        $newApartment->dimension_mq = 60;
        $newApartment->image = "http://www.case-in-legno-progettolegno.it/wp-content/uploads/2015/12/Casa-in-legno-a-Fano-0003.jpg";
        $newApartment->latitude = 45.4732;
        $newApartment->longitude = 45.4732;
        $newApartment->address_full = "via dei castagni,50,101010,Milano";
        $newApartment->is_visible = true;
        $newApartment->save();
    }
}
