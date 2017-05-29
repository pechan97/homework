using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using TareaUno.Models;

namespace TareaUno.Controllers
{
    public class CochesController : Controller
    {
        private TareaUnoContext db = new TareaUnoContext();

        // GET: Coches
        public ActionResult Index()
        {
            return View(db.Coches.ToList());
        }

        // GET: Coches/Details/5
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Coches coches = db.Coches.Find(id);
            if (coches == null)
            {
                return HttpNotFound();
            }
            return View(coches);
        }

        // GET: Coches/Create
        public ActionResult Create()
        {
            return View();
        }

        // POST: Coches/Create
        // Para protegerse de ataques de publicación excesiva, habilite las propiedades específicas a las que desea enlazarse. Para obtener 
        // más información vea https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "Id,Make,Model,Year,Cylinders")] Coches coches)
        {
            if (ModelState.IsValid)
            {
                db.Coches.Add(coches);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            return View(coches);
        }

        // GET: Coches/Edit/5
        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Coches coches = db.Coches.Find(id);
            if (coches == null)
            {
                return HttpNotFound();
            }
            return View(coches);
        }

        // POST: Coches/Edit/5
        // Para protegerse de ataques de publicación excesiva, habilite las propiedades específicas a las que desea enlazarse. Para obtener 
        // más información vea https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "Id,Make,Model,Year,Cylinders")] Coches coches)
        {
            if (ModelState.IsValid)
            {
                db.Entry(coches).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            return View(coches);
        }

        // GET: Coches/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Coches coches = db.Coches.Find(id);
            if (coches == null)
            {
                return HttpNotFound();
            }
            return View(coches);
        }

        // POST: Coches/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            Coches coches = db.Coches.Find(id);
            db.Coches.Remove(coches);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }
    }
}
