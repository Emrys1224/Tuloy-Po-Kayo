DROP TABLE IF EXISTS bookmark;
DROP TABLE IF EXISTS message_ver2;
DROP TABLE IF EXISTS message;
DROP TABLE IF EXISTS conversation;
DROP TABLE IF EXISTS gallery;
DROP TABLE IF EXISTS term_condition;
DROP TABLE IF EXISTS amenity;
DROP TABLE IF EXISTS rental_unit;
DROP TABLE IF EXISTS account;

CREATE TABLE account (
    id                  int NOT NULL AUTO_INCREMENT,
    firstname           varchar(100) NOT NULL,
    lastname            varchar(100) NOT NULL,
    email               varchar(100) NOT NULL,
    password            varchar(100) NOT NULL,
    status              enum('Owner','Anonymous','Student','Worker') DEFAULT 'Anonymous',
    contact_number      varchar(20) DEFAULT NULL,
    PRIMARY KEY         (id)
);
;
CREATE TABLE rental_unit (
	id					int NOT NULL AUTO_INCREMENT,
	name				varchar(100) NOT NULL,
	unit_number			varchar(100) DEFAULT NULL,
	street				varchar(100) DEFAULT NULL,
	purok				varchar(100) DEFAULT NULL,		/* or Name of Subdivision */
	barangay			varchar(100) NOT NULL,
	municipality		enum(
							 'Aborlan', 'Abra de Ilog', 'Abucay', 'Abulug', 'Abuyog', 'Adams', 'Agdangan', 'Aglipay', 'Agno', 'Agoncillo', 'Agoo', 'Aguilar', 'Aguinaldo', 'Agutaya', 'Ajuy', 'Akbar', 'Al-Barka', 'Alabat', 'Alabel', 'Alamada', 'Alaminos', 'Alangalang', 'Albuera', 'Alburquerque', 'Alcala', 'Alcantara', 'Alcoy', 'Alegria', 'Aleosan', 'Alfonso', 'Alfonso Castañeda', 'Alfonso Lista', 'Aliaga', 'Alicia', 'Alilem', 'Alimodian', 'Alitagtag', 'Allacapan', 'Allen', 'Almagro', 'Almeria', 'Aloguinsan', 'Aloran', 'Altavas', 'Alubijid', 'Amadeo', 'Amai Manabilang', 'Ambaguio', 'Amlan', 'Ampatuan', 'Amulung', 'Anahawan', 'Anao', 'Anda', 'Angadanan', 'Angat', 'Angeles', 'Angono', 'Anilao', 'Anini-y', 'Antequera', 'Antipas', 'Antipolo', 'Apalit', 'Aparri', 'Araceli', 'Arakan', 'Arayat', 'Argao', 'Aringay', 'Aritao', 'Aroroy', 'Arteche', 'Asingan', 'Asipulo', 'Asturias', 'Asuncion', 'Atimonan', 'Atok', 'Aurora', 'Ayungon', 'Baao', 'Babatngon', 'Bacacay', 'Bacarra', 'Baclayon', 'Bacnotan', 'Baco', 'Bacolod', 'Bacolod-Kalawi', 'Bacolor', 'Bacong', 'Bacoor', 'Bacuag', 'Badian', 'Badiangan', 'Badoc', 'Bagabag', 'Bagac', 'Bagamanoc', 'Baganga', 'Baggao', 'Bago', 'Baguio', 'Bagulin', 'Bagumbayan', 'Bais', 'Bakun', 'Balabac', 'Balabagan', 'Balagtas', 'Balamban', 'Balanga', 'Balangiga', 'Balangkayan', 'Balaoan', 'Balasan', 'Balatan', 'Balayan', 'Balbalan', 'Baleno', 'Baler', 'Balete', 'Baliangao', 'Baliguian', 'Balilihan', 'Balindong', 'Balingasag', 'Balingoan', 'Baliuag', 'Ballesteros', 'Baloi', 'Balud', 'Balungao', 'Bamban', 'Bambang', 'Banate', 'Banaue', 'Banaybanay', 'Banayoyo', 'Banga', 'Bangar', 'Bangued', 'Bangui', 'Banguingui', 'Bani', 'Banisilan', 'Banna', 'Bansalan', 'Bansud', 'Bantay', 'Bantayan', 'Banton', 'Baras', 'Barbaza', 'Barcelona', 'Barili', 'Barira', 'Barlig', 'Barobo', 'Barotac Nuevo', 'Barotac Viejo', 'Baroy', 'Barugo', 'Basay', 'Basco', 'Basey', 'Basilisa', 'Basista', 'Basud', 'Batac', 'Batad', 'Batan', 'Batangas City', 'Bataraza', 'Bato', 'Batuan', 'Bauan', 'Bauang', 'Bauko', 'Baungon', 'Bautista', 'Bay', 'Bayabas', 'Bayambang', 'Bayang', 'Bayawan', 'Baybay', 'Bayog', 'Bayombong', 'Bayugan', 'Belison', 'Benito Soliven', 'Besao', 'Bien Unido', 'Bilar', 'Biliran', 'Binalbagan', 'Binalonan', 'Binangonan', 'Bindoy', 'Bingawan', 'Binidayan', 'Binmaley', 'Binuangan', 'Biri', 'Bislig', 'Biñan', 'Boac', 'Bobon', 'Bocaue', 'Bogo', 'Bokod', 'Bolinao', 'Boliney', 'Boljoon', 'Bombon', 'Bongabon', 'Bongabong', 'Bongao', 'Bonifacio', 'Bontoc', 'Borbon', 'Borongan', 'Boston', 'Botolan', 'Braulio E. Dujali', 'Brooke''s Point', 'Buadiposo-Buntong', 'Bubong', 'Bucay', 'Bucloc', 'Buenavista', 'Bugallon', 'Bugasong', 'Buguey', 'Buguias', 'Buhi', 'Bula', 'Bulakan', 'Bulalacao', 'Bulan', 'Buldon', 'Buluan', 'Bulusan', 'Bunawan', 'Burauen', 'Burdeos', 'Burgos', 'Buruanga', 'Bustos', 'Busuanga', 'Butig', 'Butuan', 'Buug', 'Caba', 'Cabadbaran', 'Cabagan', 'Cabanatuan', 'Cabangan', 'Cabanglasan', 'Cabarroguis', 'Cabatuan', 'Cabiao', 'Cabucgayan', 'Cabugao', 'Cabusao', 'Cabuyao', 'Cadiz', 'Cagayan de Oro', 'Cagayancillo', 'Cagdianao', 'Cagwait', 'Caibiran', 'Cainta', 'Cajidiocan', 'Calabanga', 'Calaca', 'Calamba', 'Calanasan', 'Calanogas', 'Calapan', 'Calape', 'Calasiao', 'Calatagan', 'Calatrava', 'Calauag', 'Calauan', 'Calayan', 'Calbayog', 'Calbiga', 'Calinog', 'Calintaan', 'Caloocan', 'Calubian', 'Calumpit', 'Caluya', 'Camalaniugan', 'Camalig', 'Camaligan', 'Camiling', 'Can-avid', 'Canaman', 'Candaba', 'Candelaria', 'Candijay', 'Candon', 'Candoni', 'Canlaon', 'Cantilan', 'Caoayan', 'Capalonga', 'Capas', 'Capoocan', 'Capul', 'Caraga', 'Caramoan', 'Caramoran', 'Carasi', 'Carcar', 'Cardona', 'Carigara', 'Carles', 'Carmen', 'Carmona', 'Carranglan', 'Carrascal', 'Casiguran', 'Castilla', 'Castillejos', 'Cataingan', 'Catanauan', 'Catarman', 'Catbalogan', 'Cateel', 'Catigbian', 'Catmon', 'Catubig', 'Cauayan', 'Cavinti', 'Cavite City', 'Cawayan', 'Cebu City', 'Cervantes', 'Clarin', 'Claver', 'Claveria', 'Columbio', 'Compostela', 'Concepcion', 'Conner', 'Consolacion', 'Corcuera', 'Cordon', 'Cordova', 'Corella', 'Coron', 'Cortes', 'Cotabato City', 'Cuartero', 'Cuenca', 'Culaba', 'Culasi', 'Culion', 'Currimao', 'Cuyapo', 'Cuyo', 'Daanbantayan', 'Daet', 'Dagami', 'Dagohoy', 'Daguioman', 'Dagupan', 'Dalaguete', 'Damulog', 'Danao', 'Dangcagan', 'Danglas', 'Dao', 'Dapa', 'Dapitan', 'Daraga', 'Daram', 'Dasmariñas', 'Dasol', 'Datu Abdullah Sangki', 'Datu Anggal Midtimbang', 'Datu Blah T. Sinsuat', 'Datu Hoffer Ampatuan', 'Datu Montawal', 'Datu Odin Sinsuat', 'Datu Paglas', 'Datu Piang', 'Datu Salibo', 'Datu Saudi-Ampatuan', 'Datu Unsay', 'Dauin', 'Dauis', 'Davao City', 'Del Carmen', 'Del Gallego', 'Delfin Albano', 'Diadi', 'Diffun', 'Digos', 'Dilasag', 'Dimasalang', 'Dimataling', 'Dimiao', 'Dinagat', 'Dinalungan', 'Dinalupihan', 'Dinapigue', 'Dinas', 'Dingalan', 'Dingle', 'Dingras', 'Dipaculao', 'Diplahan', 'Dipolog', 'Ditsaan-Ramain', 'Divilacan', 'Dolores', 'Don Carlos', 'Don Marcelino', 'Don Victoriano Chiongbian', 'Donsol', 'Doña Remedios Trinidad', 'Duero', 'Dueñas', 'Dulag', 'Dumaguete', 'Dumalag', 'Dumalinao', 'Dumalneg', 'Dumangas', 'Dumanjug', 'Dumaran', 'Dumarao', 'Dumingag', 'Dupax del Norte', 'Dupax del Sur', 'Echague', 'El Nido', 'El Salvador', 'Enrile', 'Enrique B. Magalona', 'Enrique Villanueva', 'Escalante', 'Esperanza', 'Estancia', 'Famy', 'Ferrol', 'Flora', 'Floridablanca', 'Gabaldon', 'Gainza', 'Galimuyod', 'Gamay', 'Gamu', 'Ganassi', 'Gandara', 'Gapan', 'Garchitorena', 'Garcia Hernandez', 'Gasan', 'Gattaran', 'General Emilio Aguinaldo', 'General Luna', 'General MacArthur', 'General Mamerto Natividad', 'General Mariano Alvarez', 'General Nakar', 'General Salipada K. Pendatun', 'General Santos', 'General Tinio', 'General Trias', 'Gerona', 'Getafe', 'Gigaquit', 'Gigmoto', 'Ginatilan', 'Gingoog', 'Giporlos', 'Gitagum', 'Glan', 'Gloria', 'Goa', 'Godod', 'Gonzaga', 'Governor Generoso', 'Gregorio del Pilar', 'Guagua', 'Gubat', 'Guiguinto', 'Guihulngan', 'Guimba', 'Guimbal', 'Guinayangan', 'Guindulman', 'Guindulungan', 'Guinobatan', 'Guinsiliban', 'Guipos', 'Guiuan', 'Gumaca', 'Gutalac', 'Hadji Mohammad Ajul', 'Hadji Muhtamad', 'Hadji Panglima Tahil', 'Hagonoy', 'Hamtic', 'Hermosa', 'Hernani', 'Hilongos', 'Himamaylan', 'Hinabangan', 'Hinatuan', 'Hindang', 'Hingyon', 'Hinigaran', 'Hinoba-an', 'Hinunangan', 'Hinundayan', 'Hungduan', 'Iba', 'Ibaan', 'Ibajay', 'Igbaras', 'Iguig', 'Ilagan', 'Iligan', 'Ilog', 'Iloilo City', 'Imelda', 'Impasugong', 'Imus', 'Inabanga', 'Indanan', 'Indang', 'Infanta', 'Initao', 'Inopacan', 'Ipil', 'Iriga', 'Irosin', 'Isabel', 'Isabela', 'Isabela City', 'Isulan', 'Itbayat', 'Itogon', 'Ivana', 'Ivisan', 'Jabonga', 'Jaen', 'Jagna', 'Jalajala', 'Jamindan', 'Janiuay', 'Jaro', 'Jasaan', 'Javier', 'Jiabong', 'Jimalalud', 'Jimenez', 'Jipapad', 'Jolo', 'Jomalig', 'Jones', 'Jordan', 'Jose Abad Santos', 'Jose Dalman', 'Jose Panganiban', 'Josefina', 'Jovellar', 'Juban', 'Julita', 'Kabacan', 'Kabankalan', 'Kabasalan', 'Kabayan', 'Kabugao', 'Kabuntalan', 'Kadingilan', 'Kalamansig', 'Kalawit', 'Kalayaan', 'Kalibo', 'Kalilangan', 'Kalingalan Caluang', 'Kananga', 'Kapai', 'Kapalong', 'Kapangan', 'Kapatagan', 'Kasibu', 'Katipunan', 'Kauswagan', 'Kawayan', 'Kawit', 'Kayapa', 'Kiamba', 'Kiangan', 'Kibawe', 'Kiblawan', 'Kibungan', 'Kidapawan', 'Kinoguitan', 'Kitaotao', 'Kitcharao', 'Kolambugan', 'Koronadal', 'Kumalarang', 'La Carlota', 'La Castellana', 'La Libertad', 'La Paz', 'La Trinidad', 'Laak', 'Labangan', 'Labason', 'Labo', 'Labrador', 'Lacub', 'Lagangilang', 'Lagawe', 'Lagayan', 'Lagonglong', 'Lagonoy', 'Laguindingan', 'Lake Sebu', 'Lakewood', 'Lal-lo', 'Lala', 'Lambayong', 'Lambunao', 'Lamitan', 'Lamut', 'Langiden', 'Languyan', 'Lantapan', 'Lantawan', 'Lanuza', 'Laoac', 'Laoag', 'Laoang', 'Lapinig', 'Lapu-Lapu', 'Lapuyan', 'Larena', 'Las Navas', 'Las Nieves', 'Las Piñas', 'Lasam', 'Laua-an', 'Laur', 'Laurel', 'Lavezares', 'Lawaan', 'Lazi', 'Lebak', 'Leganes', 'Legazpi', 'Lemery', 'Leon', 'Leon B. Postigo', 'Leyte', 'Lezo', 'Lian', 'Lianga', 'Libacao', 'Libagon', 'Libertad', 'Libjo', 'Libmanan', 'Libon', 'Libona', 'Libungan', 'Licab', 'Licuan-Baay', 'Lidlidda', 'Ligao', 'Lila', 'Liliw', 'Liloan', 'Liloy', 'Limasawa', 'Limay', 'Linamon', 'Linapacan', 'Lingayen', 'Lingig', 'Lipa', 'Llanera', 'Llorente', 'Loay', 'Lobo', 'Loboc', 'Looc', 'Loon', 'Lope de Vega', 'Lopez', 'Lopez Jaena', 'Loreto', 'Los Baños', 'Luba', 'Lubang', 'Lubao', 'Lubuagan', 'Lucban', 'Lucena', 'Lugait', 'Lugus', 'Luisiana', 'Lumba-Bayabao', 'Lumbaca-Unayan', 'Lumban', 'Lumbatan', 'Lumbayanague', 'Luna', 'Lupao', 'Lupi', 'Lupon', 'Lutayan', 'Luuk', 'M''lang', 'Maasim', 'Maasin', 'Maayon', 'Mabalacat', 'Mabinay', 'Mabini', 'Mabitac', 'Mabuhay', 'MacArthur', 'Macabebe', 'Macalelon', 'Maco', 'Maconacon', 'Macrohon', 'Madalag', 'Madalum', 'Madamba', 'Maddela', 'Madrid', 'Madridejos', 'Magalang', 'Magallanes', 'Magarao', 'Magdalena', 'Magdiwang', 'Magpet', 'Magsaysay', 'Magsingal', 'Maguing', 'Mahaplag', 'Mahatao', 'Mahayag', 'Mahinog', 'Maigo', 'Maimbung', 'Mainit', 'Maitum', 'Majayjay', 'Makati', 'Makato', 'Makilala', 'Malabang', 'Malabon', 'Malabuyoc', 'Malalag', 'Malangas', 'Malapatan', 'Malasiqui', 'Malay', 'Malaybalay', 'Malibcong', 'Malilipot', 'Malimono', 'Malinao', 'Malita', 'Malitbog', 'Mallig', 'Malolos', 'Malungon', 'Maluso', 'Malvar', 'Mamasapano', 'Mambajao', 'Mamburao', 'Mambusao', 'Manabo', 'Manaoag', 'Manapla', 'Manay', 'Mandaluyong', 'Mandaon', 'Mandaue', 'Mangaldan', 'Mangatarem', 'Mangudadatu', 'Manila', 'Manito', 'Manjuyod', 'Mankayan', 'Manolo Fortich', 'Mansalay', 'Manticao', 'Manukan', 'Mapanas', 'Mapandan', 'Mapun', 'Marabut', 'Maragondon', 'Maragusan', 'Maramag', 'Marantao', 'Marawi', 'Marcos', 'Margosatubig', 'Maria', 'Maria Aurora', 'Maribojoc', 'Marihatag', 'Marikina', 'Marilao', 'Maripipi', 'Mariveles', 'Marogong', 'Masantol', 'Masbate City', 'Masinloc', 'Masiu', 'Maslog', 'Mataasnakahoy', 'Matag-ob', 'Matalam', 'Matalom', 'Matanao', 'Matanog', 'Mati', 'Matnog', 'Matuguinao', 'Matungao', 'Mauban', 'Mawab', 'Mayantoc', 'Maydolong', 'Mayorga', 'Mayoyao', 'Medellin', 'Medina', 'Mendez', 'Mercedes', 'Merida', 'Mexico', 'Meycauayan', 'Miagao', 'Midsalip', 'Midsayap', 'Milagros', 'Milaor', 'Mina', 'Minalabac', 'Minalin', 'Minglanilla', 'Moalboal', 'Mobo', 'Mogpog', 'Moises Padilla', 'Molave', 'Moncada', 'Mondragon', 'Monkayo', 'Monreal', 'Montevista', 'Morong', 'Motiong', 'Mulanay', 'Mulondo', 'Munai', 'Muntinlupa', 'Murcia', 'Mutia', 'Muñoz', 'Naawan', 'Nabas', 'Nabua', 'Nabunturan', 'Naga', 'Nagbukel', 'Nagcarlan', 'Nagtipunan', 'Naguilian', 'Naic', 'Nampicuan', 'Narra', 'Narvacan', 'Nasipit', 'Nasugbu', 'Natividad', 'Natonin', 'Naujan', 'Naval', 'Navotas', 'New Bataan', 'New Corella', 'New Lucena', 'New Washington', 'Norala', 'Northern Kabuntalan', 'Norzagaray', 'Noveleta', 'Nueva Era', 'Nueva Valencia', 'Numancia', 'Nunungan', 'Oas', 'Obando', 'Ocampo', 'Odiongan', 'Old Panamao', 'Olongapo', 'Olutanga', 'Omar', 'Opol', 'Orani', 'Oras', 'Orion', 'Ormoc', 'Oroquieta', 'Oslob', 'Oton', 'Ozamiz', 'Padada', 'Padre Burgos', 'Padre Garcia', 'Paete', 'Pagadian', 'Pagalungan', 'Pagayawan', 'Pagbilao', 'Paglat', 'Pagsanghan', 'Pagsanjan', 'Pagudpud', 'Pakil', 'Palanan', 'Palanas', 'Palapag', 'Palauig', 'Palayan', 'Palimbang', 'Palo', 'Palompon', 'Paluan', 'Pambujan', 'Pamplona', 'Panabo', 'Panaon', 'Panay', 'Pandag', 'Pandami', 'Pandan', 'Pandi', 'Panganiban', 'Pangantucan', 'Pangil', 'Panglao', 'Panglima Estino', 'Panglima Sugala', 'Pangutaran', 'Paniqui', 'Panitan', 'Pantabangan', 'Pantao Ragat', 'Pantar', 'Pantukan', 'Panukulan', 'Paoay', 'Paombong', 'Paracale', 'Paracelis', 'Paranas', 'Parang', 'Parañaque', 'Pasacao', 'Pasay', 'Pasig', 'Pasil', 'Passi', 'Pastrana', 'Pasuquin', 'Pata', 'Pateros', 'Patikul', 'Patnanungan', 'Patnongon', 'Pavia', 'Payao', 'Perez', 'Peñablanca', 'Peñaranda', 'Peñarrubia', 'Piagapo', 'Piat', 'Picong', 'Piddig', 'Pidigan', 'Pigcawayan', 'Pikit', 'Pila', 'Pilar', 'Pili', 'Pililla', 'Pinabacdao', 'Pinamalayan', 'Pinamungajan', 'Pinili', 'Pintuyan', 'Pinukpuk', 'Pio Duran', 'Pio V. Corpuz', 'Pitogo', 'Piñan', 'Placer', 'Plaridel', 'Pola', 'Polanco', 'Polangui', 'Polillo', 'Polomolok', 'Pontevedra', 'Poona Bayabao', 'Poona Piagapo', 'Porac', 'Poro', 'Pototan', 'Pozorrubio', 'Presentacion', 'President Carlos P. Garcia', 'President Manuel A. Roxas', 'President Quirino', 'President Roxas', 'Prieto Diaz', 'Prosperidad', 'Pualas', 'Pudtol', 'Puerto Galera', 'Puerto Princesa', 'Pugo', 'Pulilan', 'Pulupandan', 'Pura', 'Quezon', 'Quezon City', 'Quinapondan', 'Quirino', 'Ragay', 'Rajah Buayan', 'Ramon', 'Ramon Magsaysay', 'Ramos', 'Rapu-Rapu', 'Real', 'Reina Mercedes', 'Remedios T. Romualdez', 'Rizal', 'Rodriguez', 'Romblon', 'Ronda', 'Rosales', 'Rosario', 'Roseller Lim', 'Roxas', 'Roxas City', 'Sabangan', 'Sablan', 'Sablayan', 'Sabtang', 'Sadanga', 'Sagada', 'Sagay', 'Sagbayan', 'Saguday', 'Saguiaran', 'Sagñay', 'Saint Bernard', 'Salay', 'Salcedo', 'Sallapadan', 'Salug', 'Salvador', 'Salvador Benedicto', 'Samal', 'Samboan', 'Sampaloc', 'San Agustin', 'San Andres', 'San Antonio', 'San Benito', 'San Carlos', 'San Clemente', 'San Dionisio', 'San Emilio', 'San Enrique', 'San Esteban', 'San Fabian', 'San Felipe', 'San Fernando', 'San Francisco', 'San Gabriel', 'San Guillermo', 'San Ildefonso', 'San Isidro', 'San Jacinto', 'San Joaquin', 'San Jorge', 'San Jose', 'San Jose de Buan', 'San Jose de Buenavista', 'San Jose del Monte', 'San Juan', 'San Julian', 'San Leonardo', 'San Lorenzo', 'San Lorenzo Ruiz', 'San Luis', 'San Manuel', 'San Marcelino', 'San Mariano', 'San Mateo', 'San Miguel', 'San Narciso', 'San Nicolas', 'San Pablo', 'San Pascual', 'San Pedro', 'San Policarpo', 'San Quintin', 'San Rafael', 'San Remigio', 'San Ricardo', 'San Roque', 'San Sebastian', 'San Simon', 'San Teodoro', 'San Vicente', 'Sanchez-Mira', 'Santa', 'Santa Ana', 'Santa Barbara', 'Santa Catalina', 'Santa Cruz', 'Santa Elena', 'Santa Fe', 'Santa Ignacia', 'Santa Josefa', 'Santa Lucia', 'Santa Magdalena', 'Santa Marcela', 'Santa Margarita', 'Santa Maria', 'Santa Monica', 'Santa Praxedes', 'Santa Rita', 'Santa Rosa', 'Santa Teresita', 'Santander', 'Santiago', 'Santo Domingo', 'Santo Niño', 'Santo Tomas', 'Santol', 'Sapa-Sapa', 'Sapad', 'Sapang Dalaga', 'Sapian', 'Sara', 'Sarangani', 'Sariaya', 'Sarrat', 'Sasmuan', 'Sebaste', 'Senator Ninoy Aquino', 'Sergio Osmeña Sr.', 'Sevilla', 'Shariff Aguak', 'Shariff Saydona Mustapha', 'Siasi', 'Siaton', 'Siay', 'Siayan', 'Sibagat', 'Sibalom', 'Sibonga', 'Sibuco', 'Sibulan', 'Sibunag', 'Sibutad', 'Sibutu', 'Sierra Bullones', 'Sigay', 'Sigma', 'Sikatuna', 'Silago', 'Silang', 'Silay', 'Silvino Lobos', 'Simunul', 'Sinacaban', 'Sinait', 'Sindangan', 'Siniloan', 'Siocon', 'Sipalay', 'Sipocot', 'Siquijor', 'Sirawai', 'Siruma', 'Sison', 'Sitangkai', 'Socorro', 'Sofronio Española', 'Sogod', 'Solana', 'Solano', 'Solsona', 'Sominot', 'Sorsogon City', 'South Ubian', 'South Upi', 'Sual', 'Subic', 'Sudipen', 'Sugbongcogon', 'Sugpon', 'Sulat', 'Sulop', 'Sultan Dumalondong', 'Sultan Kudarat', 'Sultan Mastura', 'Sultan Naga Dimaporo', 'Sultan Sumagka', 'Sultan sa Barongis', 'Sumilao', 'Sumisip', 'Surallah', 'Surigao City', 'Suyo', 'T''Boli', 'Taal', 'Tabaco', 'Tabango', 'Tabina', 'Tabogon', 'Tabontabon', 'Tabuan-Lasa', 'Tabuelan', 'Tabuk', 'Tacloban', 'Tacurong', 'Tadian', 'Taft', 'Tagana-an', 'Tagapul-an', 'Tagaytay', 'Tagbilaran', 'Tagbina', 'Tagkawayan', 'Tago', 'Tagoloan', 'Tagoloan II', 'Tagudin', 'Taguig', 'Tagum', 'Talacogon', 'Talaingod', 'Talakag', 'Talalora', 'Talavera', 'Talayan', 'Talibon', 'Talipao', 'Talisay', 'Talisayan', 'Talugtug', 'Talusan', 'Tambulig', 'Tampakan', 'Tamparan', 'Tampilisan', 'Tanauan', 'Tanay', 'Tandag', 'Tandubas', 'Tangalan', 'Tangcal', 'Tangub', 'Tanjay', 'Tantangan', 'Tanudan', 'Tanza', 'Tapaz', 'Tapul', 'Taraka', 'Tarangnan', 'Tarlac City', 'Tarragona', 'Tayabas', 'Tayasan', 'Taysan', 'Taytay', 'Tayug', 'Tayum', 'Teresa', 'Ternate', 'Tiaong', 'Tibiao', 'Tigaon', 'Tigbao', 'Tigbauan', 'Tinambac', 'Tineg', 'Tinglayan', 'Tingloy', 'Tinoc', 'Tipo-Tipo', 'Titay', 'Tiwi', 'Tobias Fornier', 'Toboso', 'Toledo', 'Tolosa', 'Tomas Oppus', 'Torrijos', 'Trece Martires', 'Trento', 'Trinidad', 'Tuao', 'Tuba', 'Tubajon', 'Tubao', 'Tubaran', 'Tubay', 'Tubigon', 'Tublay', 'Tubo', 'Tubod', 'Tubungan', 'Tuburan', 'Tudela', 'Tugaya', 'Tuguegarao', 'Tukuran', 'Tulunan', 'Tumauini', 'Tunga', 'Tungawan', 'Tupi', 'Turtle Islands', 'Tuy', 'Ubay', 'Umingan', 'Ungkaya Pukan', 'Unisan', 'Upi', 'Urbiztondo', 'Urdaneta', 'Uson', 'Uyugan', 'Valderrama', 'Valencia', 'Valenzuela', 'Valladolid', 'Vallehermoso', 'Veruela', 'Victoria', 'Victorias', 'Viga', 'Vigan', 'Villaba', 'Villanueva', 'Villareal', 'Villasis', 'Villaverde', 'Villaviciosa', 'Vincenzo A. Sagun', 'Vintar', 'Vinzons', 'Virac', 'Wao', 'Zamboanga City', 'Zamboanguita', 'Zaragoza', 'Zarraga', 'Zumarraga'
							)
							NOT NULL,
	province			enum(
							'Abra', 'Agusan del Norte', 'Agusan del Sur', 'Aklan', 'Albay', 'Antique', 'Apayao', 'Aurora', 'Basilan', 'Bataan', 'Batanes', 'Batangas', 'Benguet', 'Biliran', 'Bohol', 'Bukidnon', 'Bulacan', 'Cagayan', 'Camarines Norte', 'Camarines Sur', 'Camiguin', 'Capiz', 'Catanduanes', 'Cavite', 'Cebu', 'Compostela Valley', 'Cotabato', 'Davao del Norte', 'Davao del Sur', 'Davao Oriental', 'Dinagat Islands', 'Eastern Samar', 'Guimaras', 'Ifugao', 'Ilocos Norte', 'Ilocos Sur', 'Iloilo', 'Isabela', 'Kalinga', 'La Union', 'Laguna', 'Lanao del Norte', 'Lanao del Sur', 'Leyte', 'Maguindanao', 'Marinduque', 'Masbate', 'Metro Manila', 'Misamis Occidental', 'Misamis Oriental', 'Mountain Province', 'Negros Occidental', 'Negros Oriental', 'Northern Samar', 'Nueva Ecija', 'Nueva Vizcaya', 'Occidental Mindoro', 'Oriental Mindoro', 'Palawan', 'Pampanga', 'Pangasinan', 'Quezon', 'Quirino', 'Rizal', 'Romblon', 'Samar', 'Sarangani', 'Shariff Kabunsuan', 'Siquijor', 'Sorsogon', 'South Cotabato', 'Southern Leyte', 'Sultan Kudarat', 'Sulu', 'Surigao del Norte', 'Surigao del Sur', 'Tarlac', 'Tawi-Tawi', 'Zambales', 'Zamboanga del Norte', 'Zamboanga del Sur', 'Zamboanga Sibugay'
							)
							NOT NULL,
	price 				int NOT NULL,
	type				enum('Apartment', 'Dormitory', 'House for Rent', 'Room for Rent', 'Bedspace') NOT NULL,
	description			varchar(255) DEFAULT NULL,
	owner_id			int NOT NULL,
	PRIMARY KEY			(id),
    CONSTRAINT          `fk_unit_owner`
        FOREIGN KEY (owner_id) REFERENCES account (id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE amenity (
	id 					int NOT NULL AUTO_INCREMENT,
	detail				varchar(255) NOT NULL,
	rental_unit_id 		int NOT NULL,
	PRIMARY KEY			(id),
	CONSTRAINT			`fk_rental_unitA`
		FOREIGN KEY (rental_unit_id) REFERENCES rental_unit (id)
		ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE term_condition (
	id 					int NOT NULL AUTO_INCREMENT,
	detail				varchar(255) NOT NULL,
	rental_unit_id		int NOT NULL,
	PRIMARY KEY 		(id),
	CONSTRAINT 			`fk_rental_unitB`
		FOREIGN KEY (rental_unit_id) REFERENCES rental_unit (id)
		ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE gallery (
	id 					int NOT NULL AUTO_INCREMENT,
	url					varchar(255) NOT NULL,
	description			varchar(255) NOT NULL,
	rental_unit_id		int NOT NULL,
	PRIMARY KEY 		(id),
	CONSTRAINT 			`fk_rental_unitC`
		FOREIGN KEY (rental_unit_id) REFERENCES rental_unit (id)
		ON UPDATE CASCADE ON DELETE CASCADE
);

/* Alin ba mas ok, ung dalawang table na conversation at message
 * o ung isang table lang na message?
 * Check mo ung gawa ko Table 1.1/1.2 ver 1 at Table 1 ver 2
 * dyan sa baba
 */

/* Table 1.1 ver 1 */
CREATE TABLE conversation (
	id 					int NOT NULL AUTO_INCREMENT,
	owner_id			int NOT NULL,
	tenant_id			int NOT NULL,
	PRIMARY KEY			(id),
	
	/* pano ba pwedeng maDELETE ang entry kapag lang
	 * parehas na DELETEd ung account?
	 */

	CONSTRAINT			`fk_owner`
		FOREIGN KEY (owner_id) REFERENCES account (id)
		ON UPDATE CASCADE,
	CONSTRAINT 			`fk_tenant`
		FOREIGN KEY (tenant_id) REFERENCES account (id)
		ON UPDATE CASCADE
);

/* Table 1.2 ver 1 */
CREATE TABLE message (
	id 					int NOT NULL AUTO_INCREMENT,
	conversation_id 	int NOT NULL,
	sender				int NOT NULL,
	date_time			datetime DEFAULT current_timestamp,
	content				varchar(500),
	PRIMARY KEY 		(id),
	CONSTRAINT 			`fk_conversation`
		FOREIGN KEY (conversation_id) REFERENCES conversation (id)
		ON UPDATE CASCADE ON DELETE CASCADE
);

/* Table 1 ver 2 */
CREATE TABLE message_ver2 (
	id 					int NOT NULL AUTO_INCREMENT,
	sender				int NOT NULL,
	recipient		 	int NOT NULL,
	date_time			datetime DEFAULT current_timestamp,
	content				varchar(500),
	PRIMARY KEY 		(id),
	
	/* pano ba pwedeng maDELETE ang entry kapag lang
	 * parehas na DELETEd ung account?
	 */

	CONSTRAINT 			`fk_sender`
		FOREIGN KEY (sender) REFERENCES account (id)
		ON UPDATE CASCADE,
	CONSTRAINT 			`fk_recipient`
		FOREIGN KEY (recipient) REFERENCES account (id)
		ON UPDATE CASCADE
);

CREATE TABLE bookmark (
	user 				int NOT NULL,
	rental_unit 		int NOT NULL,
	PRIMARY KEY			(user, rental_unit),
	CONSTRAINT			`fk_user`
		FOREIGN KEY (user) REFERENCES account (id)
		ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT 			`fk_rental_unitD`
		FOREIGN KEY (rental_unit) REFERENCES account (id)
		ON UPDATE CASCADE ON DELETE CASCADE
);