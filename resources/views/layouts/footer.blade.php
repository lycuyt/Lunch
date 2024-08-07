<style>
    /* Footer Styling */
    .footer {
        background-color: #333;
        color: #fff;
        padding: 20px 0;
        font-size: 14px;
    }

    .footer h5 {
        font-size: 18px;
        margin-bottom: 15px;
    }

    .footer p,
    .footer a {
        color: #ddd;
        text-decoration: none;
    }

    .footer a:hover {
        color: #fff;
        text-decoration: underline;
    }

    .footer .list-unstyled {
        padding-left: 0;
    }

    .footer .list-unstyled li {
        margin-bottom: 10px;
    }

    .footer .fa {
        margin-right: 10px;
    }
</style>
<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Column 1: About Us -->
            <div class="col-md-4">
                <h5>About Us</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet nulla eu metus cursus,
                    at consequat nisl eleifend.</p>
            </div>
            <!-- Column 2: Quick Links -->
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <!-- Column 3: Contact Info -->
            <div class="col-md-4">
                <h5>Contact Info</h5>
                <p>
                    <i class="fas fa-map-marker-alt"></i> 123 Street, City, Country<br>
                    <i class="fas fa-phone"></i> +123 456 7890<br>
                    <i class="fas fa-envelope"></i> email@example.com
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
