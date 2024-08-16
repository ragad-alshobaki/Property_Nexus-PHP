
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs - Property Nexus</title>
    <style>
      body {
    font-family: Arial, sans-serif;
 
 
 
}

.faq-section {
    max-width: 1200px; /* Increased width for two-column layout */
    margin: 0 auto;
    margin-bottom: 150px;
    background: #fff;
    padding: 100px;
    border-radius: 10px;
    /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
}

.faq-title {
    text-align: center;
    margin-bottom: 20px;
    font-size: 24px;
    color: #811bfd;
}

.faq-list {
    display: grid;
    grid-template-columns: 1fr 1fr; /* Two columns */
    gap: 20px; /* Space between items */
    list-style: none;
    padding: 0;
    margin: 0;
}

.faq-item {
    margin-bottom: 0; /* Remove bottom margin for grid layout */
}

.faq-question {
    margin: 0;
    padding: 15px;
    background: #811bfd;
    color: #fff;
    cursor: pointer;
    border-radius: 5px;
    position: relative;
    font-size: 18px;
    transition: background 0.3s ease;
}

.faq-question:hover {
    background-color: #5d11ba
}

.faq-question::after {
    content: '\25BC'; /* Unicode for down arrow */
    position: absolute;
    right: 15px;
    font-size: 18px;
    transition: transform 0.3s ease;
}

.faq-question.active::after {
    transform: rotate(180deg); /* Rotate the arrow */
}

.faq-answer {
    display: none;
    padding: 15px;
    background: #f1f1f1;
    border-radius: 5px;
    margin-top: 5px;
    font-size: 16px;
    line-height: 1.5;
}

    </style>
</head>
<body>

<div class="faq-section">
    <h2 class="faq-title">FAQs - Property Nexus</h2>
    <ul class="faq-list">
        <li class="faq-item">
            <h3 class="faq-question">What is Property Nexus?</h3>
            <div class="faq-answer">Property Nexus is a web application designed to facilitate the advertising, inquiry, and purchasing of properties. It provides a user-friendly platform for property owners, buyers, and agents to manage property listings and interactions efficiently.</div>
        </li>
        <li class="faq-item">
            <h3 class="faq-question">How do I search for properties on Property Nexus?</h3>
            <div class="faq-answer">You can search for properties by using the search bar at the top of the homepage. Enter keywords, select the city and region from the dropdown menus, and click the "Search" button to view relevant property listings.</div>
        </li>
        <li class="faq-item">
            <h3 class="faq-question">How do I list a property on Property Nexus?</h3>
            <div class="faq-answer">To list a property, you need to create an account and log in. Once logged in, click on the "Add Property" button, fill in the required details, upload images, and submit the listing.</div>
        </li>
        <li class="faq-item">
            <h3 class="faq-question">How can I contact a property owner or agent?</h3>
            <div class="faq-answer">Each property listing includes contact information for the owner or agent. You can use this information to get in touch with them directly to inquire about the property.</div>
        </li>
        <li class="faq-item">
            <h3 class="faq-question">Is Property Nexus free to use?</h3>
            <div class="faq-answer">Property Nexus offers both free and premium listing options. Basic features are available for free, while premium listings provide additional benefits such as enhanced visibility and more detailed property information.</div>
        </li>
        <li class="faq-item">
            <h3 class="faq-question">How do I subscribe to the newsletter?</h3>
            <div class="faq-answer">You can subscribe to our newsletter by entering your email address in the "Newsletter Subscription" section at the bottom of the homepage and clicking the "Subscribe" button.</div>
        </li>
        <li class="faq-item">
            <h3 class="faq-question">How do I report a problem or provide feedback?</h3>
            <div class="faq-answer">You can report problems or provide feedback by navigating to the "Feedback" section in the footer of the website. Fill out the form with your comments and submit it.</div>
        </li>
        <li class="faq-item">
            <h3 class="faq-question">How do I reset my password?</h3>
            <div class="faq-answer">If you forget your password, click on the "Sign In" button and then select "Forgot Password." Follow the instructions to reset your password via email.</div>
        </li>
        <li class="faq-item">
            <h3 class="faq-question">Can I edit or delete my property listing?</h3>
            <div class="faq-answer">Yes, you can edit or delete your property listing by logging into your account, navigating to your property listings, and selecting the appropriate option to make changes.</div>
        </li>
        <li class="faq-item">
            <h3 class="faq-question">How do I contact customer support?</h3>
            <div class="faq-answer">For any further assistance, you can contact our customer support team through the "Contact Us" section in the footer of the website. We are here to help with any questions or issues you may have.</div>
        </li>
    </ul>
</div>

<script>
    document.querySelectorAll('.faq-question').forEach(item => {
        item.addEventListener('click', () => {
            const answer = item.nextElementSibling;
            item.classList.toggle('active');
            answer.style.display = answer.style.display === 'none' || !answer.style.display ? 'block' : 'none';
        });
    });
</script>

</body>
</html>