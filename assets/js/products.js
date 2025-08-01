
const baseUrl = 'http://localhost/Sona_Chandi_Jwellers/';

// Escape HTML to prevent XSS
function escapeHtml(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}

// Complete product data
const productsData = {
    gold: {
        earrings: {
            "gold-studs-earrings": [
                { title: "Gold Studs Earrings", img: `${baseUrl}assets/products/product (1).png`, price: "₹12,999", weight:"2.5 gm", desc: "Elegant Gold Studs for daily wear." },
                { title: "Classic Gold Studs", img: `${baseUrl}assets/products/product (2).png`, price: "₹13,999",weight:"2.5 gm", desc: "Timeless gold studs." },
                {title: "XYZsdfghjk Gold Studs", img: `${baseUrl}assets/products/product (2).png`, price: "₹13,999",weight:"2.5 gm", desc: "Timeless gold studs." }
            ],
            "gold-kids-earrings": [
                { title: "Gold Kids Earrings", img: `${baseUrl}assets/products/product (1).png`, price: "₹10,499",weight:"2.5 gm", desc: "Cute gold earrings for kids." }
            ],
            "gold-drop-and-dangler": [
                { title: "Gold Drop and Dangler", img: `${baseUrl}assets/products/product (1).png`, price: "₹15,999", desc: "Trendy dangler earrings for parties." }
            ],
            "gold-hoops-and-huggies": [
                { title: "Gold Hoops and Huggies", img: `${baseUrl}assets/products/product (1).png`, price: "₹16,200", desc: "Classic hoops and huggies in gold." }
            ],
            "gold-studs-earring-men": [
                { title: "Men's Gold Studs", img: `${baseUrl}assets/products/product (1).png`, price: "₹13,499", desc: "Stylish gold studs for men." }
            ],
            "daily-wear-gold-earrings": [
                { title: "Daily Wear Gold Earrings", 
                    img: `${baseUrl}assets/products/earring_office.jpg`,
                 price: "₹11,999",
                  desc: "Comfortable gold earrings for everyday." }
            ],
            "office-wear-gold-earrings": [
                { title: "Office Wear Gold Earrings",
                    img: `${baseUrl}assets/products/earring_office.jpg`,
                    price: "₹12,500",
                     desc: "Perfect for professional look." }
            ],
            "party-wear-gold-earrings": [
                { title: "Party Wear Gold Earrings", img: `${baseUrl}assets/products/earring_office.jpg`, price: "₹18,700", desc: "Sparkle at every party." }
            ]
        },
        rings: {
            "gold-engagement-rings": [
                { title: "Gold Engagement Ring", img: `${baseUrl}assets/products/diamond_ring1.png  `, price: "₹18,999", desc: "Classic engagement ring in gold." }
            ],
            "gold-band-rings": [
                { title: "Gold Band Ring", img: `${baseUrl}assets/products/diamond_ring1.png`, price: "₹13,700", desc: "Simple and elegant gold band." }
            ],
            "gold-solitaire-rings": [
                { title: "Gold Solitaire Ring", img: `${baseUrl}assets/products/diamond_ring1.png`, price: "₹25,000", desc: "Solitaire design ring." }
            ],
            "daily-wear-gold-rings": [
                { title: "Daily Wear Gold Ring", img: `${baseUrl}assets/products/diamond_ring1.png`, price: "₹9,999", desc: "Lightweight ring for daily use." }
            ],
            "party-wear-gold-rings": [
                { title: "Party Wear Gold Ring", img: `${baseUrl}assets/products/diamond_ring1.png`, price: "₹14,500", desc: "Shine at every party." }
            ]
        },
        pendant: {
            "gold-heart-pendant": [
                { title: "Gold Heart Pendant", img: `${baseUrl}assets/products/pendant1.jpg`, price: "₹15,000", desc: "Romantic heart-shaped pendant." }
            ],
            "gold-religious-pendant": [
                { title: "Gold Religious Pendant", img: `${baseUrl}assets/products/pendant1.jpg`, price: "₹16,000", desc: "Spiritual gold pendant." }
            ],
            "daily-wear-gold-pendant": [
                { title: "Daily Wear Gold Pendant", img: `${baseUrl}assets/products/pendant1.jpg`, price: "₹12,000", desc: "Simple pendant for daily wear." }
            ],
            "party-wear-gold-pendant": [
                { title: "Party Wear Gold Pendant", img: `${baseUrl}assets/products/pendant1.jpg`, price: "₹18,000", desc: "Elegant pendant for parties." }
            ]
        },
        necklaces: {
            "gold-choker-necklace": [
                { title: "Gold Choker Necklace", img: `${baseUrl}assets/products/necklace.png`, price: "₹30,000", desc: "Stylish gold choker." }
            ],
            "gold-long-necklace": [
                { title: "Gold Long Necklace", img: `${baseUrl}assets/products/necklace.png`, price: "₹35,000", desc: "Elegant long necklace." }
            ],
            "bridal-gold-necklace": [
                { title: "Bridal Gold Necklace", img: `${baseUrl}assets/products/necklace.png`, price: "₹50,000", desc: "Grand bridal necklace." }
            ],
            "daily-wear-gold-necklace": [
                { title: "Daily Wear Gold Necklace", img: `${baseUrl}assets/products/necklace.png`, price: "₹25,000", desc: "Lightweight daily necklace." }
            ]
        },
        bracelets: {
            "gold-kada": [
                { title: "Gold Kada", img: `${baseUrl}assets/products/bracelet_gold.jpg`, price: "₹20,000", desc: "Traditional gold kada." }
            ],
            "gold-bangle": [
                { title: "Gold Bangle", img: `${baseUrl}assets/products/bracelet_gold.jpg`, price: "₹18,000", desc: "Elegant gold bangle." }
            ],
            "daily-wear-gold-bracelet": [
                { title: "Daily Wear Gold Bracelet", img: `${baseUrl}assets/products/bracelet_gold.jpg`, price: "₹15,000", desc: "Simple daily bracelet." }
            ],
            "party-wear-gold-bangle": [
                { title: "Party Wear Gold Bangle", img: `${baseUrl}assets/products/bracelet_gold.jpg`, price: "₹22,000", desc: "Fancy party bangle." }
            ]
        },
        mangalsutra: {
            "traditional-mangalsutra": [
                { title: "Traditional Mangalsutra", img: `${baseUrl}assets/products/gold_mangalsutra.jpg`,weight: "1.5gm", price: "₹25,000", desc: "Classic mangalsutra design." }
            ],
            "modern-mangalsutra": [
                { title: "Modern Mangalsutra", img: `${baseUrl}assets/products/gold_mangalsutra.jpg`, price: "₹20,000", desc: "Contemporary mangalsutra." }
            ],
            "short-mangalsutra": [
                { title: "Short Mangalsutra", img: `${baseUrl}assets/products/gold_mangalsutra.jpg`, price: "₹18,000", desc: "Compact mangalsutra." }
            ],
            "long-mangalsutra": [
                { title: "Long Mangalsutra", img: `${baseUrl}assets/products/gold_mangalsutra.jpg`, price: "₹22,000", desc: "Long elegant mangalsutra." }
            ]
        },
        goldchain: {
            "gold-rope-chain": [
                { title: "Gold Rope Chain", img: `${baseUrl}assets/products/gold_chain.jpg`, price: "₹15,000", desc: "Rope-style gold chain." }
            ],
            "gold-box-chain": [
                { title: "Gold Box Chain", img: `${baseUrl}assets/products/gold_chain.jpg`, price: "₹14,000", desc: "Box-style gold chain." }
            ],
            "daily-wear-gold-chain": [
                { title: "Daily Wear Gold Chain", img: `${baseUrl}assets/products/gold_chain.jpg`, price: "₹12,000", desc: "Lightweight daily chain." }
            ],
            "party-wear-gold-chain": [
                { title: "Party Wear Gold Chain", img: `${baseUrl}assets/products/gold_chain.jpg`, price: "₹18,000", desc: "Fancy party chain." }
            ]
        },
        goldnath: {
            "traditional-gold-nath": [
                { title: "Traditional Gold Nath", img: `${baseUrl}assets/products/gold_nath.jpg`, price: "₹8,000", desc: "Traditional nose ring." }
            ],
            "modern-gold-nath": [
                { title: "Modern Gold Nath", img: `${baseUrl}assets/products/gold_nath.jpg`, price: "₹7,500", desc: "Modern nose ring design." }
            ],
            "bridal-gold-nath": [
                { title: "Bridal Gold Nath", img: `${baseUrl}assets/products/gold_nath.jpg`, price: "₹10,000", desc: "Ornate bridal nath." }
            ],
            "daily-wear-gold-nath": [
                { title: "Daily Wear Gold Nath", img: `${baseUrl}assets/products/gold_nath.jpg`, price: "₹6,500", desc: "Simple daily nath." }
            ]
        }
    },
    silver: {
        earrings: {
            "silver-studs": [
                { title: "Silver Studs", img: `${baseUrl}assets/products/silver_earring1.jpg`, price: "₹1,999", desc: "Minimalist silver studs." }
            ],
            "silver-jhumka": [
                { title: "Silver Jhumka", img: `${baseUrl}assets/products/silver_earring1.jpg`, price: "₹2,499", desc: "Classic jhumka in silver." }
            ],
            "silver-drop-earrings": [
                { title: "Silver Drop Earrings", img: `${baseUrl}assets/products/silver_earring1.jpg`, price: "₹2,799", desc: "Elegant silver drop earrings." }
            ],
            "silver-hoops": [
                { title: "Silver Hoops", img: `${baseUrl}assets/products/silver_earring1.jpg`, price: "₹2,299", desc: "Trendy silver hoops." }
            ],
            "daily-wear-silver-earrings": [
                { title: "Daily Wear Silver Earrings", img: `${baseUrl}assets/products/silver_earring1.jpg`, price: "₹1,799", desc: "Simple silver earrings for daily wear." }
            ],
            "party-wear-silver-earrings": [
                { title: "Party Wear Silver Earrings", img: `${baseUrl}assets/products/silver_earring1.jpg`, price: "₹3,199", desc: "Fancy silver earrings for parties." }
            ]
        },
        rings: {
            "silver-band-ring": [
                { title: "Silver Band Ring", img: `${baseUrl}assets/products/silver_ring1.jpg`, price: "₹1,499", desc: "Classic band design." }
            ],
            "silver-solitaire-ring": [
                { title: "Silver Solitaire Ring", img: `${baseUrl}assets/products/silver_ring2.png`, price: "₹2,999", desc: "Elegant solitaire ring." }
            ],
            "silver-adjustable-ring": [
                { title: "Silver Adjustable Ring", img: `${baseUrl}assets/products/silver_ring3.png`, price: "₹1,799", desc: "Adjustable silver ring." }
            ],
            "mens-silver-ring": [
                { title: "Men's Silver Ring", img: `${baseUrl}assets/products/silver_ring4.png`, price: "₹2,199", desc: "Bold silver ring for men." }
            ],
            "womens-silver-ring": [
                { title: "Women's Silver Ring", img: `${baseUrl}assets/products/silver_ring5.png`, price: "₹2,099", desc: "Elegant silver ring for women." }
            ]
        },
        pendant: {
            "silver-pendant": [
                { title: "Silver Pendant", img: `${baseUrl}assets/products/silver_pendant1.png`, price: "₹1,999", desc: "Simple silver pendant." }
            ],
            "silver-religious-pendant": [
                { title: "Silver Religious Pendant", img: `${baseUrl}assets/products/silver_pendant2.png`, price: "₹2,299", desc: "Spiritual silver pendant." }
            ],
            "silver-heart-pendant": [
                { title: "Silver Heart Pendant", img: `${baseUrl}assets/products/silver_pendant3.png`, price: "₹2,099", desc: "Heart-shaped silver pendant." }
            ]
        },
        anklets: {
            "silver-anklet": [
                { title: "Silver Anklet", img: `${baseUrl}assets/products/anklet1.png`, price: "₹3,499", desc: "Classic silver anklet." }
            ],
            "oxidised-silver-anklet": [
                { title: "Oxidised Silver Anklet", img: `${baseUrl}assets/products/anklet2.png`, price: "₹3,799", desc: "Oxidised design anklet." }
            ],
            "designer-silver-anklet": [
                { title: "Designer Silver Anklet", img: `${baseUrl}assets/products/anklet3.png`, price: "₹4,199", desc: "Designer silver anklet." }
            ]
        },
        bracelets: {
            "silver-kada": [
                { title: "Silver Kada", img: `${baseUrl}assets/products/silver_bracelet1.png`, price: "₹3,999", desc: "Traditional silver kada." }
            ],
            "silver-chain-bracelet": [
                { title: "Silver Chain Bracelet", img: `${baseUrl}assets/products/silver_bracelet2.png`, price: "₹2,999", desc: "Chain-style bracelet." }
            ],
            "silver-cuff-bracelet": [
                { title: "Silver Cuff Bracelet", img: `${baseUrl}assets/products/silver_bracelet3.png`, price: "₹3,499", desc: "Cuff-style bracelet." }
            ]
        },
        chains: {
            "short-silver-chain": [
                { title: "Short Silver Chain", img: `${baseUrl}assets/products/silver_chain1.png`, price: "₹2,499", desc: "Short silver chain." }
            ],
            "long-silver-chain": [
                { title: "Long Silver Chain", img: `${baseUrl}assets/products/silver_chain2.png`, price: "₹3,499", desc: "Long silver chain." }
            ]
        },
        toe_rings: {
            "plain-silver-toe-ring": [
                { title: "Plain Silver Toe Ring", img: `${baseUrl}assets/products/silver_toe_ring1.png`, price: "₹799", desc: "Simple silver toe ring." }
            ],
            "designer-silver-toe-ring": [
                { title: "Designer Silver Toe Ring", img: `${baseUrl}assets/products/silver_toe_ring2.png`, price: "₹999", desc: "Designer silver toe ring." }
            ]
        },
        bangles: {
            "classic-silver-bangle": [
                { title: "Classic Silver Bangle", img: `${baseUrl}assets/products/silver_bangle1.png`, price: "₹3,999", desc: "Classic silver bangle." }
            ],
            "oxidised-silver-bangle": [
                { title: "Oxidised Silver Bangle", img: `${baseUrl}assets/products/silver_bangle2.png`, price: "₹4,199", desc: "Oxidised silver bangle." }
            ]
        },
        idols: {
            "silver-ganesha-idol": [
                { title: "Silver Ganesha Idol", img: `${baseUrl}assets/products/silver_idol1.png`, price: "₹5,999", desc: "Silver Ganesha idol." }
            ],
            "silver-lakshmi-idol": [
                { title: "Silver Lakshmi Idol", img: `${baseUrl}assets/products/silver_idol2.png`, price: "₹5,999", desc: "Silver Lakshmi idol." }
            ]
        },
        articles: {
            "silver-glass": [
                { title: "Silver Glass", img: `${baseUrl}assets/products/silver_article1.png`, price: "₹2,999", desc: "Silver drinking glass." }
            ],
            "silver-bowl": [
                { title: "Silver Bowl", img: `${baseUrl}assets/products/silver_article2.png`, price: "₹3,999", desc: "Silver bowl." }
            ],
            "silver-spoon": [
                { title: "Silver Spoon", img: `${baseUrl}assets/products/silver_article3.png`, price: "₹1,499", desc: "Silver spoon." }
            ]
        }
    },
    diamond: {
        earrings: {
            "diamond-studs": [
                { title: "Diamond Studs", img: `${baseUrl}assets/products/diamond_earring1.png`, price: "₹19,999", desc: "Sparkling diamond studs." }
            ],
            "diamond-hoops": [
                { title: "Diamond Hoops", img: `${baseUrl}assets/products/diamond_earring2.png`, price: "₹23,400", desc: "Trendy diamond hoops." }
            ],
            "diamond-drops": [
                { title: "Diamond Drops", img: `${baseUrl}assets/products/diamond_earring3.png`, price: "₹24,800", desc: "Elegant diamond drop earrings." }
            ],
            "diamond-jhumka": [
                { title: "Diamond Jhumka", img: `${baseUrl}assets/products/diamond_earring4.png`, price: "₹27,999", desc: "Traditional diamond jhumka." }
            ],
            "daily-wear-diamond-earrings": [
                { title: "Daily Wear Diamond Earrings", img: `${baseUrl}assets/products/diamond_earring5.png`, price: "₹18,999", desc: "Simple diamond earrings for daily wear." }
            ],
            "party-wear-diamond-earrings": [
                { title: "Party Wear Diamond Earrings", img: `${baseUrl}assets/products/diamond_earring6.png`, price: "₹29,999", desc: "Fancy diamond earrings for parties." }
            ]
        },
        rings: {
            "diamond-solitaire": [
                { title: "Diamond Solitaire Ring", img: `${baseUrl}assets/products/diamond_ring1.png`, price: "₹35,000", desc: "Brilliant solitaire diamond ring." }
            ],
            "diamond-band": [
                { title: "Diamond Band Ring", img: `${baseUrl}assets/products/diamond_ring2.png`, price: "₹30,000", desc: "Elegant diamond band ring." }
            ],
            "diamond-engagement-ring": [
                { title: "Diamond Engagement Ring", img: `${baseUrl}assets/products/diamond_ring3.png`, price: "₹40,000", desc: "Perfect for proposals." }
            ],
            "mens-diamond-ring": [
                { title: "Men's Diamond Ring", img: `${baseUrl}assets/products/diamond_ring4.png`, price: "₹32,000", desc: "Bold diamond ring for men." }
            ],
            "womens-diamond-ring": [
                { title: "Women's Diamond Ring", img: `${baseUrl}assets/products/diamond_ring5.png`, price: "₹33,000", desc: "Elegant diamond ring for women." }
            ]
        },
        pendant: {
            "diamond-pendant": [
                { title: "Diamond Pendant", img: `${baseUrl}assets/products/diamond_pendant1.png`, price: "₹20,000", desc: "Simple diamond pendant." }
            ],
            "diamond-heart-pendant": [
                { title: "Diamond Heart Pendant", img: `${baseUrl}assets/products/diamond_pendant2.png`, price: "₹22,000", desc: "Heart-shaped diamond pendant." }
            ],
            "diamond-religious-pendant": [
                { title: "Diamond Religious Pendant", img: `${baseUrl}assets/products/diamond_pendant3.png`, price: "₹21,000", desc: "Spiritual diamond pendant." }
            ]
        },
        necklaces: {
            "diamond-necklace": [
                { title: "Diamond Necklace", img: `${baseUrl}assets/products/diamond_necklace1.png`, price: "₹50,000", desc: "Elegant diamond necklace." }
            ],
            "diamond-choker": [
                { title: "Diamond Choker", img: `${baseUrl}assets/products/diamond_necklace2.png`, price: "₹45,000", desc: "Stylish diamond choker." }
            ],
            "diamond-long-necklace": [
                { title: "Diamond Long Necklace", img: `${baseUrl}assets/products/diamond_necklace3.png`, price: "₹55,000", desc: "Long diamond necklace." }
            ]
        },
        bracelets: {
            "diamond-tennis-bracelet": [
                { title: "Diamond Tennis Bracelet", img: `${baseUrl}assets/products/diamond_bracelet1.png`, price: "₹35,000", desc: "Classic tennis bracelet." }
            ],
            "diamond-cuff-bracelet": [
                { title: "Diamond Cuff Bracelet", img: `${baseUrl}assets/products/diamond_bracelet2.png`, price: "₹40,000", desc: "Elegant cuff bracelet." }
            ]
        },
        mangalsutra: {
            "classic-diamond-mangalsutra": [
                { title: "Classic Diamond Mangalsutra", img: `${baseUrl}assets/products/diamond_mangalsutra1.png`, price: "₹30,000", desc: "Traditional diamond mangalsutra." }
            ],
            "modern-diamond-mangalsutra": [
                { title: "Modern Diamond Mangalsutra", img: `${baseUrl}assets/products/diamond_mangalsutra2.png`, price: "₹28,000", desc: "Contemporary diamond mangalsutra." }
            ]
        },
        nosepins: {
            "diamond-nose-pin": [
                { title: "Diamond Nose Pin", img: `${baseUrl}assets/products/diamond_nosepin1.png`, price: "₹10,000", desc: "Simple diamond nose pin." }
            ],
            "diamond-nath": [
                { title: "Diamond Nath", img: `${baseUrl}assets/products/diamond_nosepin2.png`, price: "₹12,000", desc: "Ornate diamond nath." }
            ]
        },
        tanmaniya: {
            "traditional-tanmaniya": [
                { title: "Traditional Tanmaniya", img: `${baseUrl}assets/products/diamond_tanmaniya1.png`, price: "₹25,000", desc: "Traditional diamond tanmaniya." }
            ],
            "modern-tanmaniya": [
                { title: "Modern Tanmaniya", img: `${baseUrl}assets/products/diamond_tanmaniya2.png`, price: "₹23,000", desc: "Modern diamond tanmaniya." }
            ]
        },
        bangles: {
            "diamond-bangle": [
                { title: "Diamond Bangle", img: `${baseUrl}assets/products/diamond_bangle1.png`, price: "₹40,000", desc: "Classic diamond bangle." }
            ],
            "designer-diamond-bangle": [
                { title: "Designer Diamond Bangle", img: `${baseUrl}assets/products/diamond_bangle2.png`, price: "₹45,000", desc: "Designer diamond bangle." }
            ]
        }
    }
};

// Renders the products for the selected categories
function renderProducts(main, sub, actual) {
    console.log('renderProducts called with:', main, sub, actual);
    const grid = document.getElementById('products-grid');
    if (!grid) return;
    const products = productsData?.[main]?.[sub]?.[actual] || [];
    grid.innerHTML = '';
    if (!productsData[main] || !productsData[main][sub] || !productsData[main][sub][actual]) {
        grid.innerHTML = `<div class="col-12"><div class="alert alert-warning text-center">No products available in this category.</div></div>`;
        return;
    }
    products.forEach((product, index) => {
        grid.innerHTML += `
            <div class="col-sm-6 col-md-4 mb-4 card-container">
                <div class="product-card h-100 shadow-sm animate-fade" style="animation-delay: ${index * 0.1}s;">
                <div class="discount-banner">Flat 20% Discount</div>
                    <img src="${escapeHtml(product.img)}" class="card-img-top" alt="${escapeHtml(product.title)}">
                    <div class="card-body d-flex flex-column">
                     
                        <div class="mt-auto">
                            <div class="fw-bold mb-2">${escapeHtml(product.price)}</div>
                            <h6 class="card-title">${escapeHtml(product.weight)}</h6>
                            

                            <button class="btn add-to-cart-btn" style="width:80%; margin-bottom:8px">Add to Cart</button>
                        </div>
                          
                    </div>
                </div>
            </div>
        `;
    });
}