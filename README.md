# News

Use the following for database purposes :

CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    author VARCHAR(100) NOT NULL,
    publish_date DATE NOT NULL,
    image VARCHAR(255) NOT NULL,
    source_link VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    full_content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

.........................................................

"Breakthroughs & Research" => [

        [
            "image" => "images\New Algorithm Solves Graph Theory Problem.png",
            "title" => "New Algorithm Solves Graph Theory Problem",
            "description" => "A team at MIT has published a new, faster algorithm for solving a famous problem in graph theory, with major implications for network design.",
            "date" => "August 12, 2025",
            "author" => "By MIT News",
            "source_link" => "https://news.mit.edu/",
            "full_content" => "For decades, the 'traveling salesman problem' has been a benchmark for computational complexity in graph theory. The new algorithm, developed by Dr. Evelyn Reed and her team, utilizes quantum-inspired principles to find near-optimal solutions in a fraction of the time of previous methods. This breakthrough is expected to revolutionize logistics, circuit design, and data network optimization."
        ],

        [
            "image" => "images\AI Discovers New Geometric Proofs.png",
            "title" => "AI Discovers New Geometric Proofs",
            "description" => "Researchers are now using artificial intelligence to explore mathematical concepts, leading to previously unknown geometric theorems.",
            "date" => "August 10, 2025",
            "author" => "By Science Daily",
            "source_link" => "https://www.sciencedaily.com/",
            "full_content" => "A new AI system named 'Euclid's Dream' has been making waves in the mathematical community. By analyzing vast datasets of geometric shapes and relationships, the AI has formulated and proven several new theorems related to non-Euclidean geometry. This marks a significant step in human-AI collaboration for pure mathematical discovery, suggesting that AI can be a partner in creative reasoning, not just computation."
        ],

        [
            "image" => "images\Topology Breakthrough in 4D Spaces.png",
            "title" => "Topology Breakthrough in 4D Spaces",
            "description" => "A recent paper sheds new light on the complex nature of four-dimensional manifolds, a notoriously difficult area of topology.",
            "date" => "August 5, 2025",
            "author" => "By Quanta Magazine",
            "source_link" => "https://www.quantamagazine.org/",
            "full_content" => "Understanding shapes in dimensions beyond our own is a core challenge of topology. A new paper published in 'Nature Mathematics' provides a novel classification system for certain types of 4-manifolds. This could have profound implications for theoretical physics, particularly in string theory and models of the early universe, where extra dimensions are a key component."
        ],

        [
            "image" => "images\Progress on the Twin Prime Conjecture.png",
            "title" => "Progress on the Twin Prime Conjecture",
            "description" => "Mathematicians have made significant progress towards proving the twin prime conjecture, one of the oldest unsolved problems in number theory.",
            "date" => "July 28, 2025",
            "author" => "By Numberphile",
            "source_link" => "https://www.numberphile.com/",
            "full_content" => "The twin prime conjecture posits that there are infinitely many pairs of prime numbers that differ by only 2 (like 11 and 13). While a full proof remains elusive, recent work by Yitang Zhang and others has established finite bounds on prime gaps, bringing mathematicians closer than ever to solving this centuries-old mystery. The latest findings have narrowed the gap significantly, creating a buzz in the number theory community."
        ],
    ],

    "Figures & History" => [

        [
            "image" => "images\The Lost Notebooks of Ramanujan.png",
            "title" => "The Lost Notebooks of Ramanujan",
            "description" => "Exploring the fascinating and profound mathematical ideas found within the lost notebooks of Srinivasa Ramanujan.",
            "date" => "July 25, 2025",
            "author" => "By Math History",
            "source_link" => "https://mathshistory.st-andrews.ac.uk/",
            "full_content" => "Srinivasa Ramanujan was an Indian mathematician whose contributions to number theory, continued fractions, and infinite series were extraordinary. His 'lost notebook', a collection of pages written during the last year of his life, was rediscovered in 1976 and continues to be a source of deep mathematical problems. This article explores the history of the notebook and some of the incredible formulas contained within, many of which were centuries ahead of their time."
        ],

        [
            "image" => "images\A Profile on Maryam Mirzakhani.png",
            "title" => "A Profile on Maryam Mirzakhani",
            "description" => "Remembering the incredible life and work of Maryam Mirzakhani, the first and only female Fields Medalist.",
            "date" => "July 22, 2025",
            "author" => "By Stanford University",
            "source_link" => "https://news.stanford.edu/",
            "full_content" => "Maryam Mirzakhani was an Iranian mathematician and a professor at Stanford University. In 2014, she was awarded the Fields Medal, the most prestigious award in mathematics, for her groundbreaking work on the dynamics and geometry of Riemann surfaces. Her story is one of brilliance, perseverance, and inspiration, breaking barriers and leaving a lasting legacy in the world of mathematics."
        ],

        [
            "image" => "images\Euclid's Elements Still Relevant Today.png",
            "title" => "Euclid's Elements: Still Relevant Today?",
            "description" => "How the foundational principles laid out in Euclid's Elements over 2000 years ago still influence modern mathematics and logic.",
            "date" => "July 18, 2025",
            "author" => "By Classic Texts",
            "source_link" => "https://www.gutenberg.org/ebooks/21076",
            "full_content" => "Written around 300 BC, Euclid's 'Elements' is one of the most influential works in the history of mathematics. It served as the main textbook for teaching mathematics for over two millennia. This article examines its core axioms and propositions and traces their influence through history, showing how the rigorous, deductive logic pioneered by Euclid remains the fundamental standard for mathematical proof today."
        ],

        [
            "image" => "images\Alan Turing The Father of Computing.png",
            "title" => "Alan Turing: The Father of Computing",
            "description" => "A look into the mathematical genius of Alan Turing and his foundational work that led to the modern computer.",
            "date" => "July 15, 2025",
            "author" => "By Tech Archives",
            "source_link" => "https://www.turing.org.uk/",
            "full_content" => "Alan Turing was a brilliant mathematician and logician whose work is considered foundational to theoretical computer science and artificial intelligence. His concept of the 'Turing machine' provided a formalization of the concepts of algorithm and computation. This article explores his life, his critical role in breaking Enigma codes during WWII, and his visionary ideas that shaped the digital world we live in."
        ],
    ],

    "Puzzles & Paradoxes" => [

        [
            "image" => "images\Exploring the Monty Hall Problem.png",
            "title" => "Exploring the Monty Hall Problem",
            "description" => "A deep dive into the famous probability puzzle that has stumped even professional mathematicians. Do you switch doors?",
            "date" => "June 20, 2025",
            "author" => "By Brilliant.org",
            "source_link" => "https://brilliant.org/wiki/monty-hall-problem/",
            "full_content" => "The Monty Hall problem is a brain teaser based on a game show scenario. You are given a choice of three doors; behind one is a car, and behind the other two are goats. You pick a door, and the host, who knows what's behind the doors, opens another door to reveal a goat. He then asks if you want to switch your choice to the other remaining door. Counter-intuitively, switching doors doubles your chances of winning the car from 1/3 to 2/3. This article breaks down the probability to show why."
        ],

        [
            "image" => "images\The Seven Bridges of Königsberg.png",
            "title" => "The Seven Bridges of Königsberg",
            "description" => "The historical problem that led to the development of graph theory. Can you find a path that crosses each bridge exactly once?",
            "date" => "June 15, 2025",
            "author" => "By MathPlanet",
            "source_link" => "https://www.mathplanet.com/education/pre-algebra/graphing-and-functions/the-bridges-of-konigsberg",
            "full_content" => "The city of Königsberg was set on a river and included two large islands connected to each other and the mainland by seven bridges. The puzzle was to find a walk through the city that would cross each of those bridges once and only once. In 1736, Leonhard Euler proved that the problem has no solution. His method of analyzing the problem by abstracting it into nodes (land masses) and edges (bridges) laid the foundations of graph theory, a major branch of modern mathematics."
        ],

        [
            "image" => "images\Zeno's Paradoxes of Motion.png",
            "title" => "Zeno's Paradoxes of Motion",
            "description" => "Can you ever truly reach your destination? Exploring the ancient Greek paradoxes that question the nature of infinity and motion.",
            "date" => "June 10, 2025",
            "author" => "By Philosophy Now",
            "source_link" => "https://philosophynow.org/issues/85/Zenos_Paradox_of_the_Racetrack",
            "full_content" => "Zeno's paradoxes are a set of philosophical problems thought to have been devised by the Greek philosopher Zeno of Elea. The most famous is the paradox of Achilles and the Tortoise, which argues that the fleet-footed Achilles can never overtake a slow-moving tortoise given a head start. To do so, he must first reach the tortoise's starting point, by which time the tortoise has moved ahead. This process repeats infinitely. The paradox challenged the concepts of space, time, and infinity, and was only satisfactorily resolved with the development of calculus."
        ],

        [
            "image" => "images\The Infinite Complexity of Fractals.png",
            "title" => "The Infinite Complexity of Fractals",
            "description" => "Discover the beauty of fractals like the Mandelbrot set, where infinite complexity arises from simple mathematical rules.",
            "date" => "June 5, 2025",
            "author" => "By 3Blue1Brown",
            "source_link" => "https://www.3blue1brown.com/lessons/fractals",
            "full_content" => "A fractal is a never-ending pattern that is self-similar across different scales. They are created by repeating a simple process over and over in an ongoing feedback loop. Driven by recursion, fractals are images of dynamic systems – the pictures of Chaos. From the intricate branches of a tree to the jagged coastline of a continent, fractals are found everywhere in nature. This article explores the mathematics behind these beautiful and infinitely complex structures."
        ],

    ],

    "Math in Action" => [

        [
            "image" => "images\The Calculus Behind Machine Learning.png",
            "title" => "The Calculus Behind Machine Learning",
            "description" => "Understanding how fundamental concepts of calculus, like gradient descent, power modern artificial intelligence.",
            "date" => "May 30, 2025",
            "author" => "By Towards Data Science",
            "source_link" => "https://towardsdatascience.com/machine-learning/home",
            "full_content" => "At the heart of many machine learning algorithms is the process of optimization. To train a model, we need to find the parameters that minimize a 'loss' function. This is where calculus comes in. The algorithm of 'gradient descent' uses the derivative of the loss function to find the direction in which to tweak the parameters to make the model more accurate. Essentially, machine learning is a practical application of finding the minimum of a complex, high-dimensional function."
        ],

        [
            "image" => "images\How Cryptography Secures Your Data.png",
            "title" => "How Cryptography Secures Your Data",
            "description" => "An overview of the number theory and prime factorization that makes modern encryption possible and keeps your information safe.",
            "date" => "May 25, 2025",
            "author" => "By Computerphile",
            "source_link" => "https://www.youtube.com/user/Computerphile",
            "full_content" => "Modern public-key cryptography, the system that secures online banking and e-commerce, relies on a simple principle from number theory: it is easy to multiply two large prime numbers together, but it is extremely difficult to do the reverse (i.e., factor the product back into its primes). Your device can use a 'public key' (the product) to encrypt data, but only the recipient with the 'private key' (the original prime numbers) can decrypt it. This asymmetry is the bedrock of modern digital security."
        ],

        [
            "image" => "images\The Mathematics of Spacetime.png",
            "title" => "The Mathematics of Spacetime",
            "description" => "How Einstein's theory of general relativity uses differential geometry to describe the fabric of the universe.",
            "date" => "May 20, 2025",
            "author" => "By PBS Space Time",
            "source_link" => "https://www.youtube.com/c/pbsspacetime",
            "full_content" => "Albert Einstein's theory of general relativity describes gravity not as a force, but as a curvature of spacetime caused by mass and energy. To describe this curvature, Einstein used the mathematical language of differential geometry and tensor calculus, which had been developed by mathematicians like Riemann and Ricci. The equations of general relativity are a set of complex differential equations that precisely describe how spacetime is warped by matter, and in turn, how matter moves through that warped spacetime."
        ],

        [
            "image" => "images\Financial Modeling with Stochastic Calculus.png",
            "title" => "Financial Modeling with Stochastic Calculus",
            "description" => "A look at the complex mathematics used in the financial world to model stock prices and manage risk.",
            "date" => "May 15, 2025",
            "author" => "By Investopedia",
            "source_link" => "https://www.investopedia.com/terms/s/stochastic-calculus.asp",
            "full_content" => "Stock prices and other financial assets are notoriously difficult to predict due to their random, unpredictable nature. Stochastic calculus, a branch of mathematics that deals with random processes, provides the tools to model this uncertainty. The famous Black-Scholes model, for example, uses stochastic differential equations to price financial derivatives like options. This area of 'quantitative finance' is a major field for applied mathematicians."
        ],

    ],
