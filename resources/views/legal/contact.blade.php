<x-layout>
<x-slot:title>Contact Us - FIRA</x-slot:title>

<div class="legal-page" style="padding: 4rem 5%; max-width: 900px; margin: 0 auto; color: #1a1a1a;">
    
    <div class="legal-header" style="text-align: center; margin-bottom: 4rem;">
        <h1 style="font-size: 3rem; font-weight: 900; letter-spacing: -1px;">Get in Touch<span>.</span></h1>
        <p style="color: #666; font-size: 1.1rem; max-width: 500px; margin: 1rem auto 0;">Have a question about the system or need technical support? Drop us a message.</p>
    </div>

    <div style="display: flex; gap: 4rem; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 300px;">
            <h3 style="font-weight: 800; margin-bottom: 1.5rem;">Reach out directly</h3>
            
            <div style="margin-bottom: 1.5rem;">
                <strong style="display: block; font-size: 0.8rem; color: #888; letter-spacing: 1px;">EMAIL SUPPORT</strong>
                <a href="mailto:admin@fashionenterprise.com" style="color: #2563EB; font-weight: 600; text-decoration: none; font-size: 1.1rem;">admin@fashionenterprise.com</a>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <strong style="display: block; font-size: 0.8rem; color: #888; letter-spacing: 1px;">OFFICE ADDRESS</strong>
                <p style="color: #444; font-size: 1.1rem;">FIRA Headquarters<br>Taguig City, Metro Manila</p>
            </div>
            
            <div style="margin-bottom: 1.5rem;">
                <strong style="display: block; font-size: 0.8rem; color: #888; letter-spacing: 1px;">SYSTEM STATUS</strong>
                <p style="color: #064E3B; font-weight: 600; font-size: 1.1rem;">● All systems operational</p>
            </div>
        </div>

        <div style="flex: 1.5; min-width: 300px; background: white; padding: 2.5rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
            <form action="#" method="POST">
                @csrf
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.75rem; font-weight: 800; color: #888; margin-bottom: 0.5rem; letter-spacing: 0.5px;">YOUR NAME</label>
                    <input type="text" style="width: 100%; padding: 12px 0; border: none; border-bottom: 1px solid #ddd; font-size: 1rem; outline: none; transition: 0.3s;" placeholder="Juan Dela Cruz">
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.75rem; font-weight: 800; color: #888; margin-bottom: 0.5rem; letter-spacing: 0.5px;">EMAIL ADDRESS</label>
                    <input type="email" style="width: 100%; padding: 12px 0; border: none; border-bottom: 1px solid #ddd; font-size: 1rem; outline: none; transition: 0.3s;" placeholder="juan@email.com">
                </div>

                <div style="margin-bottom: 2rem;">
                    <label style="display: block; font-size: 0.75rem; font-weight: 800; color: #888; margin-bottom: 0.5rem; letter-spacing: 0.5px;">MESSAGE</label>
                    <textarea rows="4" style="width: 100%; padding: 12px 0; border: none; border-bottom: 1px solid #ddd; font-size: 1rem; outline: none; resize: none; transition: 0.3s;" placeholder="How can we help you?"></textarea>
                </div>

                <button type="button" style="width: 100%; background: #FBBF24; color: #1a1a1a; padding: 16px; border: none; border-radius: 30px; font-weight: 800; cursor: pointer; transition: 0.3s;">SEND MESSAGE</button>
            </form>
        </div>
    </div>
    
    <div style="margin-top: 4rem; text-align: center;">
        <a href="/" style="color: #666; text-decoration: none; font-weight: 600;">← Back to FIRA Home</a>
    </div>

</div>
</x-layout>