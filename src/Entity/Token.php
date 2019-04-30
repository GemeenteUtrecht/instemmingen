<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ActivityLogBundle\Entity\Interfaces\StringableInterface;


use App\Controller\TokenController;

/**
 * Token 
 * 
 * Beschrijving
 * 
 * @category   	Entity
 *
 * @author     	Ruben van der Linde <ruben@conduction.nl>
 * @license    	EUPL 1.2 https://opensource.org/licenses/EUPL-1.2 *
 * @version    	1.0
 *
 * @link   		http//:www.conduction.nl
 * @package		Common Ground
 * @subpackage  Instemming
 *  
 * @ApiResource( 
 *  collectionOperations={
 *  	"get"={
 *  		"normalizationContext"={"groups"={"read"}},
 *  		"denormalizationContext"={"groups"={"write"}},
 *      	"path"="/tokens",
 *  		"openapi_context" = {
 * 				"summary" = "Haalt een verzameling van tokens op"
 *  		}
 *  	},
 *  	"post"={
 *  		"normalizationContext"={"groups"={"read"}},
 *  		"denormalizationContext"={"groups"={"write"}},
 *      	"path"="/tokens",
 *  		"openapi_context" = {
 * 					"summary" = "Maak een token aan"
 *  		}
 *  	}, 
 *  },
 * 	itemOperations={
 *     "get"={
 *  		"normalizationContext"={"groups"={"read"}},
 *  		"denormalizationContext"={"groups"={"write"}},
 *      	"path"="/tokens/{id}",
 *  		"openapi_context" = {
 * 				"summary" = "Haal een specifiek token op"
 *  		}
 *  	},
 *     "put"={
 *  		"normalizationContext"={"groups"={"read"}},
 *  		"denormalizationContext"={"groups"={"write"}},
 *      	"path"="/tokens/{id}",
 *  		"openapi_context" = {
 *  				"summary" = "Vervang een specifiek token"
 *  		}
 *  	},
 *     "delete"={
 *  		"normalizationContext"={},
 *  		"denormalizationContext"={},
 *      	"path"="/tokens/{id}",
 *  		"openapi_context" = {
 * 				"summary" = "Verwijder een specifiek token"
 *  		}
 *  	},
 *     "person"={
 *         "method"="POST",
 *         "path"="/tokens/{id}/person",
 *         "controller"= TokenController::class,
 *     	   "normalization_context"={"groups"={"read"}},
 *     	   "denormalization_context"={"groups"={"person"}},
 *         "openapi_context" = {
 *         		"summary" = "Koppel BSN",
 *         		"description" = "Koppel een BSN nummer aan deze token aan de hand van een digid controlle",
 *          	"consumes" = {
 *              	"application/json",
 *               	"text/html",
 *            	},
 *             	"produces" = {
 *         			"application/json"
 *            	},
 *             	"responses" = {
 *         			"201" = {
 *         				"description" = "Koppeling gemaakt"
 *         			},	
 *         			"400" = {
 *         				"description" = "Ongeldige aanvraag"
 *         			},
 *         			"404" = {
 *         				"description" = "Token niet gevonden"
 *         			}
 *            	}
 *         }
 *     },
 *     "refuse"={
 *         "method"="POST",
 *         "path"="/tokens/{id}/refuse",
 *         "controller"= TokenController::class,
 *     	   "normalization_context"={},
 *     	   "denormalization_context"={},
 *         "openapi_context" = {
 *         		"summary" = "Wijs af",
 *         		"description" = "Wijs de vraag af waarvoor dit token is gemaakt",
 *          	"consumes" = {
 *              	"application/json",
 *               	"text/html",
 *            	},
 *             	"produces" = {
 *         			"application/json"
 *            	},
 *             	"responses" = {
 *         			"200" = {
 *         				"description" = "Vraag afgewezen"
 *         			},	
 *         			"400" = {
 *         				"description" = "Ongeldige aanvraag"
 *         			},
 *         			"404" = {
 *         				"description" = "Token niet gevonden"
 *         			}
 *            	}
 *         }
 *     },
 *     "confirm"={
 *         "method"="POST",
 *         "path"="/tokens/{id}/confirm",
 *         "controller"= TokenController::class,
 *     	   "normalization_context"={},
 *     	   "denormalization_context"={},
 *         "openapi_context" = {
 *         		"summary" = "Bevestig",
 *         		"description" = "Bevestig de vraag waarvoor dit token is gemaakt",
 *          	"consumes" = {
 *              	"application/json",
 *               	"text/html",
 *            	},
 *             	"produces" = {
 *         			"application/json"
 *            	},
 *             	"responses" = {
 *         			"200" = {
 *         				"description" = "Vraag bevestigd"
 *         			},	
 *         			"400" = {
 *         				"description" = "Ongeldige aanvraag"
 *         			},
 *         			"404" = {
 *         				"description" = "Token niet gevonden"
 *         			}
 *            	}
 *         }
 *     },
 *     "log"={
 *         	"method"="GET",
 *         	"path"="/tokens/{id}/log",
 *          "controller"= HuwelijkController::class,
 *     		"normalization_context"={"groups"={"read"}},
 *     		"denormalization_context"={"groups"={"write"}},
 *         	"openapi_context" = {
 *         		"summary" = "Logboek inzien",
 *         		"description" = "Geeft een array van eerdere versies en wijzigingen van dit object",
 *          	"consumes" = {
 *              	"application/json",
 *               	"text/html",
 *            	},
 *             	"produces" = {
 *         			"application/json"
 *            	},
 *             	"responses" = {
 *         			"200" = {
 *         				"description" = "Een overzicht van versies"
 *         			},	
 *         			"400" = {
 *         				"description" = "Ongeldige aanvraag"
 *         			},
 *         			"404" = {
 *         				"description" = "Token niet gevonden"
 *         			}
 *            	}            
 *         }
 *     }
 *  }   
 * )
 * @ORM\Entity
 * @Gedmo\Loggable(logEntryClass="ActivityLogBundle\Entity\LogEntry")
 * @ORM\HasLifecycleCallbacks
 */
class Token implements StringableInterface
{	
	/**
	* @ORM\Id
	* @ORM\Column(name="token", type="string")
	* @ORM\GeneratedValue(strategy="CUSTOM")
	* @ORM\CustomIdGenerator(class="App\Doctrine\TokenGenerator")
	* @Groups({"read"})
	*/
	private $token;
	
	/**
	 * De unieke identificatie van dit object binnen de organisatie die dit object heeft gecreeerd. <br /><b>Schema:</b> <a href="https://schema.org/identifier">https://schema.org/identifier</a>
	 *
	 * @var string
	 * @ORM\Column(
	 *     type     = "string",
	 *     length   = 40,
	 *     nullable=true
	 * )
	 * @Assert\Length(
	 *      max = 40,
	 *      maxMessage = "Het RSIN kan niet langer dan {{ limit }} tekens zijn"
	 * )
	 * @Groups({"read", "write"})
	 * @ApiProperty(
	 *     attributes={
	 *         "openapi_context"={
	 *             "type"="string",
	 *             "example"="6a36c2c4-213e-4348-a467-dfa3a30f64aa",
	 *             "description"="De unieke identificatie van dit object de organisatie die dit object heeft gecreeerd.",
	 *             "maxLength"=40
	 *         }
	 *     }
	 * )
	 * @Gedmo\Versioned
	 */
	public $identificatie;
	
	/**
	 * Het Huwelijk waartoe deze partner behoord
	 *
	 * @var \App\Entity\Organisatie
	 * @ORM\ManyToOne(targetEntity="\App\Entity\Organisatie", cascade={"persist", "remove"}, inversedBy="tokens")
	 * @ORM\JoinColumn(referencedColumnName="id")
	 *
	 */
	public $bronOrganisatie;
	
	/**
	 * @var string Een "Y-m-d H:i:s" waarde bijv. "2018-12-31 13:33:05" ofwel "Jaar-dag-maand uur:minut:seconde"
	 * @Assert\DateTime
	 * @ORM\Column(
	 *     type     = "datetime",
	 *     nullable = true
	 * )
	 * @Groups({"read"})
	 */
	public $acceptatieDatum;
	
	/**
	 * @var string Een "Y-m-d H:i:s" waarde bijv. "2018-12-31 13:33:05" ofwel "Jaar-dag-maand uur:minut:seconde"
	 * @Assert\DateTime
	 * @ORM\Column(
	 *     type     = "datetime",
	 *     nullable = true
	 * )
	 * @Groups({"read"})
	 */
	public $weigerDatum;
	
	/**
	 * Het object waar deze token aan vast zit
	 *
	 * @var string
	 *
	 * @ORM\Column(nullable=true)
	 * @ApiProperty(iri="https://schema.org/identifier")
	 * @Groups({"read"})
	 */
	public $objectType;
	
	/**
	 * Het identificatie nummer van het object waar deze token aan vast zit <br /><br /><b>Schema:</b> <a href="https://schema.org/identifier">https://schema.org/identifier</a>
	 *
	 * @var string
	 *
	 * @ORM\Column(
	 *     type     = "integer",
	 *     nullable=true)
	 * @ApiProperty(iri="https://schema.org/identifier")
	 * @Groups({"read"})
	 */
	public $objectId;
	
	/**
	 * @var string Een "Y-m-d H:i:s" waarde bijv. "2018-12-31 13:33:05" ofwel "Jaar-dag-maand uur:minut:seconde"
	 * @Assert\DateTime
	 * @ORM\Column(
	 *     type     = "datetime"
	 * )
	 * @Groups({"read"})
	 */
	public $registratieDatum;
	
	/**
	 * @var string Een "Y-m-d H:i:s" waarde bijv. "2018-12-31 13:33:05" ofwel "Jaar-dag-maand uur:minut:seconde"
	 * @Assert\DateTime
	 * @ORM\Column(
	 *     type     = "datetime",
	 *     nullable = true
	 * )
	 * @Groups({"read"})
	 */
	public $gebruikt;
	
	/**
	 * @var string Een "Y-m-d H:i:s" waarde bijv. "2018-12-31 13:33:05" ofwel "Jaar-dag-maand uur:minut:seconde"
	 * @Assert\DateTime
	 * @ORM\Column(
	 *     type     = "datetime",
	 *     nullable = true
	 * )
	 * @Groups({"read"})
	 */
	public $geldigTot;
	
	/**
	 * @return string
	 */
	public function toString(){
		return $this->token;
	}
	
	/**
	 * Vanuit rendering perspectief (voor bijvoorbeeld logging of berichten) is het belangrijk dat we een entiteit altijd naar string kunnen omzetten
	 */
	public function __toString()
	{
		return $this->toString();
	}
	
	/**
	 * De prePersist functie wordt aangeroepen wanneer de entiteit voor het eerst wordt opgeslagen in de database. Dit staat ons toe om een set aan additionele initiële waardes toe te voegen.
	 *
	 * @ORM\PrePersist
	 */
	public function prePersist()
	{
		$this->registratieDatum = new \ Datetime();
		$this->geldigTot= new \ Datetime('+ 2 week');
		// We want to add some default stuff here like products, productgroups, paymentproviders, templates, clientGroups, mailinglists and ledgers
		return $this;
	}
	
	public function getToken()
	{
		return $this->token;
	}
	
}
