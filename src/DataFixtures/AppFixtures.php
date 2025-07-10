<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use App\Entity\Category;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    
    public function load(ObjectManager $manager): void
    {
        // Création des catégories
        $categories = [
            'Plats Chauds' => (new Category())
                ->setTitle('Plats Chauds')
                ->setSlug('plats-chauds'),
            'Entrées' => (new Category())
                ->setTitle('Entrées')
                ->setSlug('entrees'),
            'Desserts' => (new Category())
                ->setTitle('Desserts')
                ->setSlug('desserts'),
        ];

        foreach ($categories as $category) {
            $manager->persist($category);
        }

        // Recettes avec leur catégorie associée
        $recipes = [
            [
                'title' => 'Riz cantonais',
                'content' => "<h1>Riz cantonais</h1><h2>Ingrédients (pour 4 personnes) :</h2><ul><li>300 g de riz basmati cuit (idéalement de la veille)</li><li>150 g de petits pois (frais ou surgelés)</li><li>2 œufs</li><li>100 g de jambon blanc (ou de lardons)</li><li>1 carotte</li><li>2 oignons nouveaux (ou 1 oignon jaune)</li><li>2 cuillères à soupe de sauce soja</li><li>1 cuillère à soupe d'huile de sésame (facultatif)</li><li>Huile végétale (tournesol ou arachide)</li><li>Sel, poivre</li></ul><h2>Préparation :</h2><ol><li><strong>Préparation des ingrédients :</strong><ul><li>Coupez le jambon en dés.</li><li>Épluchez et coupez la carotte en petits dés.</li><li>Émincez les oignons nouveaux (ou l'oignon jaune).</li><li>Battez les œufs en omelette.</li></ul></li><li><strong>Cuisson des légumes :</strong><ul><li>Dans un wok ou une grande poêle, faites chauffer un peu d'huile végétale.</li><li>Ajoutez les carottes et faites-les revenir pendant quelques minutes jusqu'à ce qu'elles soient tendres.</li><li>Ajoutez les petits pois et faites-les cuire pendant 2-3 minutes.</li><li>Ajoutez les oignons et faites-les revenir jusqu'à ce qu'ils soient translucides.</li></ul></li><li><strong>Cuisson des œufs :</strong><ul><li>Poussez les légumes sur le côté de la poêle.</li><li>Versez les œufs battus et faites-les cuire en omelette brouillée.</li><li>Coupez l'omelette en petits morceaux.</li></ul></li><li><strong>Cuisson du riz et du jambon :</strong><ul><li>Ajoutez le riz cuit, le jambon et la sauce soja.</li><li>Faites sauter le tout pendant quelques minutes, en mélangeant bien, jusqu'à ce que le riz soit chaud et bien imprégné de sauce.</li><li>Si vous le souhaitez, ajoutez l'huile de sésame pour parfumer.</li></ul></li><li><strong>Service :</strong><ul><li>Servez chaud.</li></ul></li></ol><h2>Conseils :</h2><ul><li>Utilisez du riz cuit de la veille, il sera moins collant.</li><li>Vous pouvez ajouter d'autres ingrédients, comme des crevettes, des champignons ou des dés d'ananas.</li><li>Pour une version plus épicée, ajoutez un peu de piment ou de sauce sriracha.</li></ul><p>Bon appétit !</p>",
                'duration' => 30,
                'category' => 'Plats Chauds'
            ],
            [
                'title' => 'Spaghetti Carbonara',
                'content' => "<h1>Spaghetti Carbonara</h1><h2>Ingrédients :</h2><ul><li>200 g de spaghetti</li><li>100 g de pancetta</li><li>2 œufs</li><li>50 g de parmesan râpé</li><li>Sel, poivre</li></ul><h2>Préparation :</h2><ol><li>Cuire les spaghetti.</li><li>Faire revenir la pancetta.</li><li>Mélanger les œufs et le parmesan.</li><li>Ajouter les spaghetti et la pancetta.</li><li>Servir chaud.</li></ol>",
                'duration' => 20,
                'category' => 'Plats Chauds'
            ],
            [
                'title' => 'Salade César',
                'content' => "<h1>Salade César</h1><h2>Ingrédients :</h2><ul><li>1 laitue romaine</li><li>100 g de poulet grillé</li><li>50 g de croûtons</li><li>30 g de parmesan</li><li>Sauce César</li></ul><h2>Préparation :</h2><ol><li>Couper la laitue.</li><li>Ajouter le poulet, les croûtons et le parmesan.</li><li>Assaisonner avec la sauce César.</li><li>Servir frais.</li></ol>",
                'duration' => 15,
                'category' => 'Entrées'
            ],
            [
                'title' => 'Poulet Tikka Masala',
                'content' => "<h1>Poulet Tikka Masala</h1><h2>Ingrédients :</h2><ul><li>500 g de poulet</li><li>200 g de yaourt nature</li><li>2 oignons</li><li>3 gousses d'ail</li><li>1 morceau de gingembre</li><li>200 g de tomates concassées</li><li>Épices (cumin, coriandre, curcuma, garam masala)</li><li>Crème fraîche</li><li>Sel, poivre</li></ul><h2>Préparation :</h2><ol><li>Mariner le poulet avec le yaourt et les épices.</li><li>Faire revenir les oignons, l'ail et le gingembre.</li><li>Ajouter les tomates et cuire.</li><li>Ajouter le poulet et cuire jusqu'à ce qu'il soit tendre.</li><li>Ajouter la crème fraîche et servir chaud.</li></ol>",
                'duration' => 40,
                'category' => 'Plats Chauds'
            ],
            [
                'title' => 'Quiche Lorraine',
                'content' => "<h1>Quiche Lorraine</h1><h2>Ingrédients :</h2><ul><li>1 pâte brisée</li><li>200 g de lardons</li><li>3 œufs</li><li>20 cl de crème fraîche</li><li>100 g de gruyère râpé</li><li>Sel, poivre</li></ul><h2>Préparation :</h2><ol><li>Préchauffer le four à 180°C.</li><li>Étaler la pâte dans un moule.</li><li>Répartir les lardons sur la pâte.</li><li>Mélanger les œufs, la crème et le gruyère.</li><li>Verser le mélange sur les lardons.</li><li>Cuire au four pendant 30 minutes.</li></ol>",
                'duration' => 45,
                'category' => 'Plats Chauds'
            ],
            [
                'title' => 'Soupe à l\'oignon',
                'content' => "<h1>Soupe à l'oignon</h1><h2>Ingrédients :</h2><ul><li>500 g d'oignons</li><li>1 litre de bouillon de bœuf</li><li>50 g de beurre</li><li>1 cuillère à soupe de farine</li><li>Sel, poivre</li><li>Gruyère râpé</li><li>Tranches de pain</li></ul><h2>Préparation :</h2><ol><li>Émincer les oignons et les faire revenir dans le beurre.</li><li>Ajouter la farine et mélanger.</li><li>Ajouter le bouillon et cuire pendant 30 minutes.</li><li>Verser la soupe dans des bols, ajouter le pain et le gruyère.</li><li>Gratiner au four et servir chaud.</li></ol>",
                'duration' => 60,
                'category' => 'Entrées'
            ],
            [
                'title' => 'Tarte Tatin',
                'content' => "<h1>Tarte Tatin</h1><h2>Ingrédients :</h2><ul><li>1 pâte feuilletée</li><li>6 pommes</li><li>150 g de sucre</li><li>100 g de beurre</li></ul><h2>Préparation :</h2><ol><li>Préchauffer le four à 180°C.</li><li>Éplucher et couper les pommes en quartiers.</li><li>Faire un caramel avec le sucre et le beurre.</li><li>Ajouter les pommes et cuire pendant 10 minutes.</li><li>Recouvrir avec la pâte et cuire au four pendant 30 minutes.</li><li>Retourner la tarte et servir tiède.</li></ol>",
                'duration' => 50,
                'category' => 'Desserts'
            ],
            [
                'title' => 'Bœuf Bourguignon',
                'content' => "<h1>Bœuf Bourguignon</h1><h2>Ingrédients :</h2><ul><li>1 kg de bœuf</li><li>200 g de lardons</li><li>4 carottes</li><li>2 oignons</li><li>2 gousses d'ail</li><li>50 cl de vin rouge</li><li>Bouquet garni</li><li>Sel, poivre</li></ul><h2>Préparation :</h2><ol><li>Faire revenir les lardons et les oignons.</li><li>Ajouter le bœuf et faire dorer.</li><li>Ajouter les carottes, l'ail et le bouquet garni.</li><li>Verser le vin et cuire à feu doux pendant 3 heures.</li><li>Servir chaud avec des pommes de terre.</li></ol>",
                'duration' => 180,
                'category' => 'Plats Chauds'
            ],
            [
                'title' => 'Crêpes',
                'content' => "<h1>Crêpes</h1><h2>Ingrédients :</h2><ul><li>250 g de farine</li><li>4 œufs</li><li>50 cl de lait</li><li>50 g de beurre fondu</li><li>1 pincée de sel</li></ul><h2>Préparation :</h2><ol><li>Mélanger la farine et le sel.</li><li>Ajouter les œufs et mélanger.</li><li>Ajouter le lait progressivement.</li><li>Ajouter le beurre fondu.</li><li>Cuire les crêpes dans une poêle chaude.</li><li>Servir avec du sucre, du chocolat ou de la confiture.</li></ol>",
                'duration' => 30,
                'category' => 'Desserts'
            ],
            [
                'title' => 'Mousse au chocolat',
                'content' => "<h1>Mousse au chocolat</h1><h2>Ingrédients :</h2><ul><li>200 g de chocolat noir</li><li>6 œufs</li><li>1 pincée de sel</li></ul><h2>Préparation :</h2><ol><li>Faire fondre le chocolat au bain-marie.</li><li>Séparer les blancs des jaunes d'œufs.</li><li>Ajouter les jaunes au chocolat fondu.</li><li>Monter les blancs en neige avec une pincée de sel.</li><li>Incorporer délicatement les blancs au chocolat.</li><li>Réfrigérer pendant au moins 3 heures.</li><li>Servir frais.</li></ol>",
                'duration' => 20,
                'category' => 'Desserts'
            ]
        ];

        foreach ($recipes as $data) {
            $recipe = new Recipe();
            $recipe->setTitle($data['title']);
            $recipe->setSlug($this->slugger->slug($data['title'])->lower());
            $recipe->setContent($data['content']);
            $recipe->setCreatedAt(new DateTimeImmutable());
            $recipe->setUpdatedAt(new DateTimeImmutable());
            $recipe->setDuration($data['duration']);
            $recipe->setCategory($categories[$data['category']]);
            $manager->persist($recipe);
        }

        $manager->flush();
    }
}