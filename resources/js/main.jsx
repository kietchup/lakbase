import React, { useState } from 'react';
import ReactDOM from 'react-dom/client';
import { ethers } from 'ethers';

function WalletButton() {
    const [walletAddress, setWalletAddress] = useState(null);
    const [loading, setLoading] = useState(false);

    async function connectWallet() {
        if (!window.ethereum) {
            alert('MetaMask not found. Please install it.');
            return;
        }

        try {
            setLoading(true);
            const provider = new ethers.BrowserProvider(window.ethereum);
            const accounts = await provider.send('eth_requestAccounts', []);
            setWalletAddress(accounts[0]);
        } catch (error) {
            console.error('Wallet connection error:', error);
        } finally {
            setLoading(false);
        }
    }

    return (
        <button
            onClick={connectWallet}
            disabled={loading}
            className={`bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition ${loading ? 'opacity-70 cursor-wait' : ''
                }`}
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                className="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                strokeWidth={2}
            >
                <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    d="M17 9V7a5 5 0 00-10 0v2M5 12h14m-3 8H8a2 2 0 01-2-2v-4h12v4a2 2 0 01-2 2z"
                />
            </svg>

            {loading
                ? 'Connecting...'
                : walletAddress
                    ? 'Wallet Connected'
                    : 'Connect Wallet'}
        </button>
    );
}

// Mount ONLY inside the header's wallet-button div
const rootEl = document.getElementById('wallet-button');
if (rootEl) {
    ReactDOM.createRoot(rootEl).render(<WalletButton />);
}


// import React, { useState } from 'react';
// import ReactDOM from 'react-dom/client';
// import { ethers } from 'ethers';

// function App() {
//   const [walletAddress, setWalletAddress] = useState(null);

//   async function connectWallet() {
//     if (!window.ethereum) {
//       alert('MetaMask not found. Please install it.');
//       return;
//     }

//     try {
//       const provider = new ethers.BrowserProvider(window.ethereum);
//       const accounts = await provider.send('eth_requestAccounts', []);
//       setWalletAddress(accounts[0]);
//     } catch (error) {
//       console.error('Error connecting wallet:', error);
//     }
//   }

//   return (
//     <div className="flex items-center justify-center min-h-screen bg-gray-100">
//       <button
//         onClick={connectWallet}
//         className="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition"
//       >
//         <svg
//           xmlns="http://www.w3.org/2000/svg"
//           className="h-4 w-4"
//           fill="none"
//           viewBox="0 0 24 24"
//           stroke="currentColor"
//           strokeWidth={2}
//         >
//           <path
//             strokeLinecap="round"
//             strokeLinejoin="round"
//             d="M17 9V7a5 5 0 00-10 0v2M5 12h14m-3 8H8a2 2 0 01-2-2v-4h12v4a2 2 0 01-2 2z"
//           />
//         </svg>
//         {walletAddress ? 'Wallet Connected' : 'Connect Wallet'}
//       </button>
//     </div>
//   );
// }

// ReactDOM.createRoot(document.getElementById('root')).render(<App />);


// import React from "react";
// import ReactDOM from "react-dom/client";
// import {
//   WagmiProvider,
//   useAccount,
//   configureChains,
//   createConfig,
// } from "wagmi";
// import { base, mainnet } from "wagmi/chains";
// import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
// import {
//   RainbowKitProvider,
//   ConnectButton,
//   getDefaultConfig,
//   useConnectModal,
// } from "@rainbow-me/rainbowkit";
// import "@rainbow-me/rainbowkit/styles.css";

// // ✅ Wagmi + RainbowKit configuration
// const config = getDefaultConfig({
//   appName: "LakBase | Gamified Tourism",
//   projectId: "YOUR_WALLETCONNECT_PROJECT_ID", // ⚠️ Replace with your real WalletConnect ID
//   chains: [base, mainnet],
// });

// const queryClient = new QueryClient();

// // ✅ Custom Button (Alternative to RainbowKit Default)
// function CustomConnectButton() {
//   const { openConnectModal } = useConnectModal();
//   const { isConnected } = useAccount();

//   return (
//     <button
//       onClick={openConnectModal}
//       disabled={isConnected}
//       className={`${
//         isConnected ? "bg-green-600" : "bg-indigo-600 hover:bg-indigo-700"
//       } text-white px-4 py-2 rounded-lg flex items-center gap-2 transition`}
//     >
//       <svg
//         xmlns="http://www.w3.org/2000/svg"
//         className="h-4 w-4"
//         fill="none"
//         viewBox="0 0 24 24"
//         stroke="currentColor"
//       >
//         <path
//           strokeLinecap="round"
//           strokeLinejoin="round"
//           strokeWidth="2"
//           d="M17 9V7a5 5 0 00-10 0v2M5 12h14m-3 8H8a2 2 0 01-2-2v-4h12v4a2 2 0 01-2 2z"
//         />
//       </svg>
//       {isConnected ? "Wallet Connected" : "Connect Wallet"}
//     </button>
//   );
// }

// // ✅ Wallet Info
// function WalletInfo() {
//   const { address, isConnected } = useAccount();

//   if (!isConnected) {
//     return <p className="text-gray-600 text-sm">Please connect your wallet 👆</p>;
//   }

//   return (
//     <div className="text-sm text-gray-800 mt-2">
//       ✅ Connected wallet:{" "}
//       <span className="font-semibold text-indigo-700">
//         {address.slice(0, 6)}...{address.slice(-4)}
//       </span>
//     </div>
//   );
// }

// // ✅ Main App
// function App() {
//   return (
//     <WagmiProvider config={config}>
//       <QueryClientProvider client={queryClient}>
//         <RainbowKitProvider>
//           <div className="flex flex-col items-center justify-center gap-3 font-sans">
//             {/* You can switch between Custom or Default Connect Button */}
//             <CustomConnectButton />
//             {/* Or use this default RainbowKit one: */}
//             {/* <ConnectButton /> */}
//             <WalletInfo />
//           </div>
//         </RainbowKitProvider>
//       </QueryClientProvider>
//     </WagmiProvider>
//   );
// }

// // ✅ Render the app
// ReactDOM.createRoot(document.getElementById("root")).render(<App />);
